<?php
/**
 * JPrettify class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @license New BSD licence
 * @version 1.1
 *
 */

/**
 *
 * Syntax highlighting tool of source code snippets in an html page.
 *
 * This widget enable syntax highlighting of code snippets in your web application using Google Code Prettify.
 * ({@link http://code.google.com/p/google-code-prettify/}).
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 */

class JPrettify extends CWidget
{
    /**
     * @var string specifies the language file extensions - e.g 'css'
     *
     * Defaults to null.
     */
    private $_lang=null;
    /**
     * @var string A Yii path alias.
     */
    public $pathAlias;
    /**
     * @var string Name of the source file.
     * Defaults to an empty string.
     */
    public $fileName;
    /**
     * @var string source code to highlight
     * Defaults to an empty string.
     */
    public $code='';
    /**
     * @var array the HTML attributes that should be rendered in the HTML pre tag
     * which contain the code of the computer languages.
     */
    public $htmlOptions=array();
    /**
     * @var boolean show line number or not?
     * Defaults to TRUE.
     */
    public $showLineNumbers = false;
    /**
     * @var string start with following line number if showLineNumbers = true
     * Defaults to 0.
     */
    public $firstLineNumber = 0;

    /**
     * @var string Name of CSS-theme (see theme folder: prettify, desert, sunburst)
     * Defaults to an empty string.
     */
    public $themeName='prettify';

    static protected $languageFileExtensions   = array(

        "bsh"   => "default",
        "c"     => "default",
        "cc"    => "default",
        "cpp"   => "default",
        "cs"    => "default",
        "csh"   => "default",
        "cyc"   => "default",
        "cv"    => "default",
        "htm"   => "default",
        "html"  => "default",
        "java"  => "default",
        "js"    => "default",
        "m"     => "default",
        "mxml"  => "default",
        "perl"  => "default",
        "pl"    => "default",
        "pm"    => "default",
        "py"    => "default",
        "rb"    => "default",
        "sh"    => "default",
        "xhtml" => "default",
        "xml"   => "default",
        "xls"   => "default",
        "php"   => "default",
        "coffee"   => "default",

        // the external language file extensions
        "apollo" => "lang-apollo.js",
        "css"    => "lang-css.js",
        "php5"   => "lang-php5.js",
        "go"     => "lang-go.js",
        "hs"     => "lang-hs.js",
        "lisp"   => "lang-lisp.js",
        "lua"    => "lang-lua.js",
        "ml"     => "lang-ml.js",
        "n"      => "lang-n.js",
        "proto"  => "lang-proto.js",
        "scala"  => "lang-scala.js",
        "sql"    => "lang-sql.js",
        "tex"    => "lang-tex.js",
        "vb"     => "lang-vb.js",
        "vhdl"   => "lang-vhdl.js",
        "wiki"   => "lang-wiki.js",
        "xq"     => "lang-xq.js",
        "yaml"   => "lang-yaml.js",
    );

    protected function setLang($language)
    {
        $this->_lang=strtolower($language);

        if (!array_key_exists($this->_lang,self::$languageFileExtensions))
            throw new CException(Yii::t(__CLASS__,__CLASS__.' > Invalid language file extensions: {value}.', array('{value}'=>$this->_lang)));
    }

    protected function getLang()
    {
        return $this->_lang;
    }

    /**
     * Initializes the widget.
     * This method registers all needed client scripts
     */
    public function init()
    {
        parent::init();

        $htmlClass="";

        if ($this->lang)
            $htmlClass .="lang-".$this->lang;

        if ($this->showLineNumbers)
            $htmlClass .=" linenums";

        if ($this->showLineNumbers && ($this->firstLineNumber>0))
            $htmlClass .=":".$this->firstLineNumber;

        if (isset($this->htmlOptions['class']))
            $htmlClass .=" ".$this->htmlOptions['class'];

        if ($htmlClass)
            $this->htmlOptions['class']=$htmlClass;

        $baseUrl = CHtml::asset(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
        $url = $baseUrl.'/css/themes/'.$this->themeName.'.css';
        $lib = $baseUrl.'/js/prettify.js';

        if ($this->lang){
            if (self::$languageFileExtensions[$this->lang]=="default"){
                $extension='';
            } else {
                $extension = $baseUrl.'/js/'.self::$languageFileExtensions[$this->lang];
            }
        } else {
            $extension='';
        }

        $js="$('pre').addClass('prettyprint');prettyPrint();";

        Yii::app()->getClientScript()
           ->registerCoreScript('jquery')
           ->registerScriptFile($lib, CClientScript::POS_HEAD)
           ->registerScript(__CLASS__,$js, CClientScript::POS_READY)
           ->registerCssFile($url);

        if ($extension)
            Yii::app()->getClientScript()->registerScriptFile($extension,CClientScript::POS_HEAD);

        echo CHtml::openTag("pre", $this->htmlOptions). "\n";
        ob_start();
    }

    /**
     * Renders the close tag of the container.
     */
    public function run()
    {
        $this->code=ob_get_clean();
        $this->readFile();
        echo CHtml::encode($this->code);
        echo CHtml::closeTag("pre");
    }

    /**
     * Read the code from the source file
     *
     * @access protected
     * @return void
     */
    protected function readFile()
    {
        if ($this->fileName){
            $path="";
            if(strpos($this->pathAlias,'.')) // it is a path alias ?
                $path=Yii::getPathOfAlias($this->pathAlias);

            if($path){
                $fileName = $path.DIRECTORY_SEPARATOR.$this->fileName;
            } else {
                $this->code = @file_get_contents($this->fileName);
                $this->code = ($this->code)
                            ? $this->code
                            :$this->fileName . ' - no connection to the net?';
                return;
            }

            if (is_file($fileName)) {
                $this->code = file_get_contents($fileName);
            } else {
                echo "$fileName wasn't detected as file!";
            }
        }
    }
}
