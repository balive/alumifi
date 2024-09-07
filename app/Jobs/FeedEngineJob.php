<?php

namespace App\Jobs;

use App\Events\FeedEngineEvent;
use App\Integrations\ChatGPT;
use App\Integrations\WeaviateAPI;
use App\Models\File;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Smalot\PdfParser\Parser;


class FeedEngineJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FeedEngineEvent $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void

     */
    public function handle()
    {
        set_time_limit(0);

        echo "Job Started \n";

        $content = $this->getPdfContentInChunks("uploads/" . $this->event->fileName);

        File::updateOrCreate(['name'=> $this->event->fileName ]);

        $this->feedGPT($this->event->fileName,$content);

        echo "Job Finished \n";
    }

    public function getPdfContentInChunks($pdfFile, $pagesPerChunk = 1)
    {
        try {
            $parser             = new Parser();
            $pdf                = $parser->parseFile(public_path($pdfFile));
            $pages              = $pdf->getPages();

            $chunks = collect($pages)->chunk($pagesPerChunk)->map(function ($chunk)  {
                return $chunk->map(function ($page) {
                    $content = $page->getText();
                    return $content;
                })->filter()->toArray();
            })->toArray();

            // Combine chunk arrays into a single array
            $result = array_map(function ($chunk) {
                return implode(' ', $chunk);
            }, $chunks);

            return $result;

        } catch (\Exception $e) {
            // Handle exceptions appropriately, e.g., log or rethrow
            echo $e->getMessage();
            return null;
        }
    }

    public function feedGPT($fileName,$contents)
    {
        set_time_limit(0);

        $data       = [];

        foreach($contents as $content){
            $data [] = [
                'id'            => $fileName,
                'title'         => "doc feed",
                'description'   => $content
            ];
        }

        if(count($data) > 0){
            $weaviate = new WeaviateAPI();

            foreach ($data as $key => $datum){
                echo "processing page $key \n";

                $weaviate->createChunks('chunk_id', [$datum]);
            }
        }
        else{
            return null ;
        }
    }

}
