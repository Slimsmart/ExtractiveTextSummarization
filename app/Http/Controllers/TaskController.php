<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Misc\Tool\StopWords\English;
use App\Http\Misc\TextRankFacade;
use Illuminate\Support\Facades\Session;
use App\Http\Misc\WordHelper;

class TaskController extends Controller
{
    private $textRankFacade;
    private $wordHandler;
    private $docxConv;

    function __construct()
    {
        $this->textRankFacade = new TextRankFacade();
        $words = new English();   

        $this->textRankFacade->setStopWords($words);
    }

    /**
     * Load welcome page
     * 
     * @return mixed
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Submit text to summarize
     * 
     * @param Request $request
     * 
     * @return mixed
     */
    public function summarizeText(Request $request)
    {
        $request->validate(['article'=>'required']);

        // Array of the most important keywords:
        //$result = $this->textRankFacade->getOnlyKeyWords($request->article);

        // Array of the sentences from the most important part of the text:
        $result = $this->textRankFacade->getHighlights($request->article);
        // Array of the most important sentences from the text:
        //$result = $this->textRankFacade->summarizeTextBasic($request->article);
        $request->session()->flash('original', $request->article);
        $request->session()->flash('summarized',$result);

        return redirect()->route('home');
    }

    /**
     * Submit text to summarize
     * 
     * @param Request $request
     * 
     * @return mixed
     */
    public function summarizeDocument(Request $request)
    {
        $request->validate(['doc'=>'required|file|max:2000']);

        $wh = new WordHelper($request->file('doc'));
        $text = $wh->docx2text();


        // Array of the most important keywords:
        //$result = $this->textRankFacade->getOnlyKeyWords($request->article);

        // Array of the sentences from the most important part of the text:
        $result = $this->textRankFacade->getHighlights($text);
        // Array of the most important sentences from the text:
        //$result = $this->textRankFacade->summarizeTextBasic($request->article);
        $request->session()->flash('original', $text);
        $request->session()->flash('summarized', $result);

        return redirect()->route('home');
    }
}
