<?php
// Testing Snippets extension for Bolt

namespace Bolt\Extension\Bolt\TitleCase;

use Bolt\Extensions\Snippets\Location as SnippetLocation;

class Extension extends \Bolt\BaseExtension
{

    private $smallwords = "a,aan,achter,af,an,and,at,bij,binnen,boven,buiten,but,by,de,door,een,else,en,for,from,het,if,in,in,into,inzake,is,langs,maar,met,na,naar,naast,nabij,namens,nor,of,of,off,om,omtrent,on,ondanks,onder,ook,op,or,out,over,over,per,richting,rond,rondom,te,tegen,the,then,tijdens,to,tot,tussen,uit,van,vanaf,vanuit,vanwege,via,volgens,voor,voorbij,wegens,when,with,zonder";

    public function getName()
    {
        return "Title Case";
    }

    function initialize()
    {

        $this->addTwigFilter('titlecase', 'titleCaseFilter');

    }


    function titleCaseFilter($str)
    {

        $str = $this->titleCase($str);

        return new \Twig_Markup($str, 'UTF-8');

    }


    private function titleCase($str)
    {

        $smallwordsarray = explode(",", $this->smallwords);

        $words = explode(' ', strtolower($str));

        foreach ($words as $key => $word) {
            if ($key == 0 or !in_array($word, $smallwordsarray)) {
                $words[$key] = ucwords($word);
            }
        }

        return implode(' ', $words);

    }

}
