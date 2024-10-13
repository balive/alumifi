<?php

namespace App\Http\Controllers;

use App\Integrations\ChatGPT;
use App\Integrations\WeaviateAPI;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Prompt;
use App\Models\Setting;
use App\Models\User;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

use Laravel\Cashier\Subscription;


class HomeController extends Controller
{
    public function test()
    {

//        dd(auth()->user()->current_subscription()->plan_id);

//        $weaviate = new WeaviateAPI();
//        dd($weaviate->getChunks(' ' ,'sad'));
//        dd($weaviate->getChunks('TKNe6f7a27ad4cb6c23efd169cf7b0afb105ba7e629467816992a7c9be5c45638f5', 'printing'));
//        dd($weaviate->deleteChunks("Stoelting's_Pharmacology_&_Physiology_in_A_-_Pamela_Flood.pdf"));
//        dd(json_decode($weaviate->getObjects() ,true));
//        dd(json_decode($weaviate->getSchema() ,true));
//        dd(json_decode($weaviate->createSchema() ,true));


        $gpt = new ChatGPT('gpt-4o-mini');

        dd($gpt->ask('hi'));

    }

    public function dashboard()
    {
        $prompts = Prompt::all();

        return view('dashboard.index', compact('prompts') );
    }

    public function handle_gpt_send(Request $request)
    {
        $bias                   = $request->get('bias');
        $scraped_data           = $request->get('scraped_data');
        $question               = $request->get('text');
        $conversation_id        = $request->get('conversation_id');
        $rewrite                = $request->get('rewrite');
        $url                    = $request->get('url');

        $gpt_history = '';
        if(isset($conversation_id)){
            $gpt_history = $this->getGPTHistoryPrompt($conversation_id);
        }

        $analyzed_data = $this->gptAnalyze($bias,$question,$scraped_data,$gpt_history,$rewrite);

        if($rewrite && $bias != 0){
            $answer = $analyzed_data['html_assessment'] . $analyzed_data['html_critique'];
        }elseif($rewrite && $bias == 0) {
            $answer = $analyzed_data['html_assessment'];
        }
        else {
            $answer = $analyzed_data['html'];
        }

        if(!isset($conversation_id)){
            $conversation_name = $this->nameConversation("This is a conversation, give it a name, please only respond with the name nothing else, here is part of the conversation  " . strip_tags($answer));

            $conversation = Conversation::create([
                'user_id'   => isset(auth()->user()->id) ? auth()->user()->id : null,
                'name'      => $conversation_name,
                'url'       => $url
            ]);

            $conversation_id = $conversation->id;
        }

        if($conversation_id){
            if($rewrite){
                $conversation = Conversation::find($conversation_id);

                if(!isset($conversation->assessment)){
                    $conversation->assessment = $analyzed_data['html_assessment'];
                }

                $conversation->url = $url;
                $conversation->save();

                $conversation = Conversation::find($conversation_id);

                if($bias != 0){
                    $answer = $conversation->assessment . $analyzed_data['html_critique'];

                }else {
                    $answer = $conversation->assessment;
                }
            }

            Message::create([
                'user_id'           => isset(auth()->user()->id) ? auth()->user()->id : null,
                'conversation_id'   => $conversation_id,
                'question'          => $question,
                'answer'            => $answer,
            ]);
        }

        return response()->json([
            'message'           => $answer,
            'conversation_id'   => isset($conversation) ? $conversation->id : $conversation_id ,
            'conversation_name' => isset($conversation) ? $conversation->name : null ,
            'status'            => 200,
        ]);
    }

    public function getGPTHistoryPrompt($conversation_id)
    {
        $latest_messages = Message::where('conversation_id' ,$conversation_id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $array = [];
        foreach ($latest_messages as $latest_two_message){
            $array [] = [
                'id'        =>  $latest_two_message['id'],
                'question'   => $latest_two_message['question'],
                'answer'    =>  $latest_two_message['answer'],
            ];
        }

        $ids = array_column($array, 'id');
        array_multisort($ids, SORT_ASC, $array);

        $gpt_prompt  = '';

        foreach ($array as $item){
            $gpt_prompt .= "\n\rQuestion:" . $item['question'] . "\n\rAnswer:" . $item['answer'];
        }

        return $gpt_prompt;
    }

    public function getMessages($chunks)
    {
        $information = implode('\n', array_map(function($item) {
            return $item['content'] ;
        }, $chunks));

        return $information;
    }

    public function gptAnalyze($bias,$question,$information = "NO INFORMATION PROVIDED" , $conversation_history, $rewrite = 0)
    {
        $settings  = Setting::find(1);

        $result = null;
        $gpt = new ChatGPT(isset($settings['engine']) ? $settings['engine'] :'gpt-4o-mini' );
        if($rewrite && $bias != 0){
            $prompt = "You are an expert $bias expert and consultant who is biased towards $bias, you are helpful and you answer only the questions related to the $bias bias , please re-write this article from thr $bias bias perspective 
                        here is the article : [$information]
                        
                        - provide assessment from the original article a in bullet point list ( make bias in CAPS ), to ascertain its current bias in this regard, provide the bias ratings in percentage with nice intro at the beginning...here is the list of the all the biases u should consider and provide how close the article is to each bias in percentage, and make sure that total percentage for all the perspectives is 100%:
                         Left (for context : liberal, democrat)
                        Socialist
                        Libertarian
                        Right (for context :  conservative, Republican)
                        Christian
                        Islamic
                        Buddhist
                        Agnostic (for context :  Atheist leaning)
                        Libertarian
                        Scientific (for context : academic/materialist)
                        Critical Thinking (for context :  conspiracy)
                        Green (for context : environmentalist)
                        Crypto (for context : bitcoin)

                        - do an actual critique of this article, to judge it, bring that full $bias bias to that article, and explain according to $bias that his position is not looked upon favorably and provide a nice intro before diving deeper...

                        - display the heading of the assessment and critique with this html code <h4 style='color: #019cc1 !important;'>heading name</h4> and provide a nice intro underneath the heading  before diving deeper 
                        
                        (please return your answer in organized html code and use these tags <h6> for heading , <p> for sentences , & <br> between each sentence if needed)
                        
                        return in json in this format {'html_assessment' : '' , 'html_critique' : ''} 
                        ";

        }
        else if($rewrite && $bias == 0){

            $prompt = " please re-write this article  
                        here is the article : [$information]
                        
                        - provide assessment from the original article a in bullet point list ( make bias in CAPS ), to ascertain its current bias in this regard, provide the bias ratings in percentage with nice intro at the beginning...here is the list of the all the biases u should consider and provide how close the article is to each bias in percentage, and make sure that total percentage for all the perspectives is 100%:
                         Left (for context : liberal, democrat)
                        Socialist
                        Libertarian
                        Right (for context :  conservative, Republican)
                        Christian
                        Islamic
                        Buddhist
                        Agnostic (for context :  Atheist leaning)
                        Libertarian
                        Scientific (for context : academic/materialist)
                        Skeptical (for context :  conspiracy)
                        Green (for context : environmentalist)
                        Crypto (for context : bitcoin)
                        Jewish 


                        - display the heading of the assessment with this html code <h4 style='color: #019cc1 !important;'>heading name</h4> and provide a nice intro underneath the heading  before diving deeper 
                        
                        (please return your answer in organized html code and use these tags <h6> for heading , <p> for sentences , & <br> between each sentence if needed)
                        
                        return in json in this format {'html_assessment' : ''} 
                        ";

        }
        else {
            $prompt = "You are an expert $bias expert and consultant who is biased towards $bias, you are helpful and you answer the questions from the $bias bias only, you pick the reliable answer from the provided information and answer in your professional way, and your responses are returned in an organized html code
                   
                       please follow the following instructions :
                       - Do not just copy the information , but rephrase them in your way, and provide only the related information to the question asked. 
                       - do not answer unrelated questions and apologize politely that you can not answer that , if the information provided doesn't have an answer simply refuse to answer politely. 
                       - this is only $bias related, do not get out of the scope of the information provided. 
                       - questions about weather, politics or general random questions are not allowed, do not answer them. 
                       - you need to sound very confident , when answering questions do not say that they are coming from the information provided at all or that your answer is based on them , but act as a $bias expert and consultant , more like a human being not a bot. 
                       - add hyperlinks with target='_top' to your messages whenever possible, referring to the information provided , only if there is a url.
                       - make sure to add target='_top' to the hyperlink [ <a target='_top'>link</a> ] , do not add the link itself but a hyperlink text only.
                       - add html tags and line breaks using the <p> , <br> tags to provide better readable answers.
                       - break small and large paragraphs & texts into multiple phrases & sentences using break lines & reasonable spacing so the user can read it in a nice way. 
                       - always return your response in html only using html tags to format the text using <h6>, <p> for text formatting and <br> for spacing between sentences. 
                       - if Information is not provided please use your own knowledge base to answer questions
                       
                       
                        Here is the full conversation for context: [$conversation_history]


                        here is the question: [$question] 
                        
                        
                        here is the information you should use for answering: [$information]
                        
                        
                        
                        
                        (please return your answer in organized html code and use these tags <h6> for heading , <p> for sentences , & <br> between each sentence)
         
                        return in json in this format { 'html' : ''}               
                        ";
        }

//        $prompt .= "return in json in this format {'assessment' : '' , 'html' : ''}";

        $response = $gpt->sendMessage($prompt, true);
        $jsonString  = $response['choices'][0]['message']['content'];
        $data        = json_decode($jsonString , true);

        return $data;
    }

    public function nameConversation($prompt)
    {
        $settings  = Setting::find(1);

        $result = null;
        $gpt = new ChatGPT(isset($settings['engine']) ? $settings['engine'] :'gpt-4o-mini' );

        $result = null;
        $response = $gpt->sendMessage($prompt);

        if(isset($response['choices'][0]['message']['content'])){
            $result     =  $response['choices'][0]['message']['content'];
        }

        return $result;
    }

    public function canSend()
    {
        $remaining_credits = auth()->user()->remaining_credits;

        if($remaining_credits > 0){

            $prompts_count = auth()->user()->current_subscription()->quantity + 1;

            auth()->user()->remaining_credits = auth()->user()->remaining_credits - 1;
            auth()->user()->save();

            Subscription::where('id' , auth()->user()->current_subscription()->id)->update([
                'quantity' => $prompts_count
            ]);

            return true;

        }else{

            Subscription::where('id' , auth()->user()->current_subscription()->id)->update([
                'quote_exceeded' => 1
            ]);

            return false;
        }
    }

    public function fetch(Request $request)
    {
        $info = $this->getList($request->get('url'));

        return response()->json([
            'status'=> 200,
            'data' => $info
        ]);
    }

    public function getList($url)
    {
        $client = new Client();
        try {
            $response = $client->get($url);
            $html = $response->getBody()->getContents();

            // Load the HTML into DOMDocument
            $dom = new \DOMDocument();
            @$dom->loadHTML($html); // Suppress warnings due to malformed HTML

            // Remove <script> and <style> tags
            $xpath = new \DOMXPath($dom);
            foreach ($xpath->query('//script|//style|//svg|//button|//source|//footer|//header|//img|//button|//a') as $node) {
                $node->parentNode->removeChild($node);
            }

            // Extract the content of the <body> tag
            $body = $dom->getElementsByTagName('body')->item(0);
            $bodyContent = '';

            if ($body) {
                foreach ($body->childNodes as $child) {
                    $bodyContent .= $dom->saveHTML($child);
                }
            }

            return strip_tags($bodyContent);
        } catch (\Exception $e) {
            // Handle any exceptions here
            return $e->getMessage();
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function settings()
    {
        $settings  = Setting::find(1);


        return view('dashboard.settings' , compact('settings'));
    }

    public function store_settings(Request $request)
    {
        $engine = $request->get('engine');

        Setting::updateOrCreate([
            'id'=> 1
        ] , [

            'engine' => $engine,
        ]);

        flash('Updated Successfully');

        return redirect()->back();
    }

}
