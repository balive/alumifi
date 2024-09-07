<?php

namespace App\Integrations;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Weaviate\Weaviate;

class WeaviateAPI
{
    protected $weaviate;

    protected  $url ;

    public function __construct($engine = 'gpt-3.5-turbo')
    {
        $headers = [
            'X-Openai-Api-Key'=> env('OPENAI_APIKEY'),
        ];

        $this->url = env('WEAVIATE_URL');

        $this->weaviate = new Weaviate(env('WEAVIATE_URL'), env('WEAVIATE_KEY') ,$headers);
    }

    public function deleteChunks($identifier = "chunk_id")
    {
        $this->weaviate->batch()->delete('Chunk', [
            'path' => ['identifier'],
            'operator' => 'Equal',
            'valueString' => $identifier,
        ]);
    }

    public function getChunks($identifier = "chunk_id" , $text)
    {
        $query = <<<GQL
        {
          Get {
            Chunk(
              nearText: {
                  concepts: "$text"
                  certainty: 0.9
              }
            ) {
                content,
                sourceLink, 
                identifier
                
            }
          }
        }
GQL;

//    $query = <<<GQL
//        {
//          Get {
//            Chunk(
//              nearText: {
//                  concepts: "$text"
//                  certainty: 0.9
//              }
//              limit: 5
//              where: {
//                  path: ["identifier"]
//                  operator: Equal
//                  valueString: "$identifier"
//              }
//            ) {
//                content,
//                sourceLink,
//                identifier
//
//            }
//          }
//        }
//GQL;

        $response = $this->weaviate->graphql()->get($query);

        if (isset($response['errors'])) {
            return $response;
        }

        return $response ? $response['data']['Get']['Chunk'] : ['response is not set '];
    }

    public function getSchema()
    {
        $response  = Http::withHeader('Authorization'  ,'Bearer ' . env('WEAVIATE_KEY'))
            ->get("$this->url/v1/schema");

        return $response->getbody()->getContents();
    }

    public function getObjects()
    {
        $response  = Http::withHeader('Authorization'  ,'Bearer ' . env('WEAVIATE_KEY'))
            ->get("$this->url/v1/objects?class=Chunk");

        return $response->getbody()->getContents();
    }

    public function createSchema()
    {
        $url = "$this->url/v1/schema";
        $data = '{
	"class": "Chunk",
	"description": "Some chunk of knowledge",
	"vectorizer": "text2vec-openai",
	"moduleConfig": {
		"text2vec-openai": {
			"model": "ada",
			"modelVersion": "002",
			"type": "text"
		}
	},
	"properties": [
		{
			"name": "identifier",
			"description": "The identifier of the particular chunk of knowledge",
			"dataType": [
				"string"
			],
			"moduleConfig": {
				"text2vec-openai": {
					"skip": true
				}
			}
		},
		{
			"name": "content",
			"description": "The contents",
			"dataType": [
				"text"
			]
		},
		{
			"name": "source",
			"description": "The source type",
			"dataType": [
				"string"
			],
			"moduleConfig": {
				"text2vec-openai": {
					"skip": true
				}
			}
		},
		{
			"name": "sourceLink",
			"description": "URL to the article",
			"dataType": [
				"string"
			],
			"moduleConfig": {
				"text2vec-openai": {
					"skip": true
				}
			}
		}
	]
}';

        $client = new Client();
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('WEAVIATE_KEY'),
                ],
                'body' => $data,
            ]);
        } catch (GuzzleException $e) {

            return $e->getMessage();
        }

        // Process the response as needed
        $responseData = $response->getBody()->getContents();

        return $responseData;

    }

    public function createChunks($chunkId, $data)
    {
        // reset chunks before storing them
//        $this->deleteChunks($chunkId);

        $objects = [];

        foreach ($data as $item) {

//            $cleaned = $this->cleanUpContent($article['description']);
            $objects[] = [
                'class'      => 'Chunk',
                'properties' => [
                    'identifier'    => $item['id'],
                    'content'       => $item['description'],
                    'source'        => "doc",
                    'sourceLink'    => ""
                ],
            ];
        }

        return $this->weaviate->batch()->create($objects);
    }

    function cleanUpContent($content)
    {
        return Str::of($content)
            ->replace('<', ' <')
            ->stripTags()
            ->replace(['\r', '\n'], ' ')
            ->replaceMatches('/\s+/', ' ')
            ->trim();
    }

    function chunkContent($content)
    {
        $tokensPerCharacter = 0.4;
        $tokenLimit = 150;
        $chunkCharacterLimit = $tokenLimit / $tokensPerCharacter;

        // Split the input string into an array of sentences
        $sentences = collect(preg_split('/(?<=[.?!])\s?(?=[a-z])/i', $content));

        $chunks = $sentences->chunkWhile(function ($sentence, $key, $chunk) use ($chunkCharacterLimit) {
            return $chunk->sum(function ($sentence) {
                    return mb_strlen($sentence, 'UTF-8');
                }) < $chunkCharacterLimit;
        })->map(function ($chunk) {
            $value = $chunk->implode(' ');
            $checksum = md5($value);

            return [
                'checksum' => $checksum,
                'value' => $value,
            ];
        });

        return $chunks->all();
    }
}