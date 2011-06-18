<?php
/**
 * UserAgent Helper
 *
 * This helper will build Dynamic Menu
 *
 * @author M. M. Rifat-Un-Nabi <to.rifat@gmail.com>
 * @package UserAgent
 * @subpackage UserAgent.views.helpers
 */

App::import('Helper', 'Html');

class UserAgentHelper extends AppHelper {
/**
 * Helper dependencies
 *
 * @var array
 * @access public
 */
    var $helpers = array('Html');

/**
 * User Agent Information
 *
 * @var string
 * @access public
 */
    public $useragent = null;

/**
 * URL of the current Browser/OS/Device
 *
 * @var string
 * @access Private
 */
    protected $__link = '#';

/**
 * Title of the current Browser/OS/Device
 *
 * @var string
 * @access Private
 */
    protected $__title = 'Unknown';

/**
 * Icon code the of current Browser/OS/Device
 *
 * @var string
 * @access Private
 */
    protected $__code = null;

/**
 * Constructor.
 *
 * @access public
 */
    function __construct($config=array()) {
        $this->useragent = getenv('HTTP_USER_AGENT');
    }
    
/**
 * Detect Web Browser Version.
 *
 * @param string title
 * @return string Web Browser Title with Version
 * @access private
 */
    private function detect_browser_version($title){

        //fix for Opera's (and others) UA string changes in v10.00
        $version = '';
        $start=$title;
        if((strtolower($this->__title)==strtolower("Opera") || strtolower($this->__title)==strtolower("Opera Next")) && preg_match('/Version/i', $this->useragent))
            $start="Version";
        elseif(strtolower($this->__title)==strtolower("Opera Mobi") && preg_match('/Version/i', $this->useragent))
            $start="Version";
        elseif(strtolower($this->__title)==strtolower("Safari") && preg_match('/Version/i', $this->useragent))
            $start="Version";
        elseif(strtolower($this->__title)==strtolower("Pre") && preg_match('/Version/i', $this->useragent))
            $start="Version";
        elseif(strtolower($this->__title)==strtolower("Android Webkit"))
            $start="Version";
        elseif(strtolower($this->__title)==strtolower("Links"))
            $start="Links (";
        elseif(strtolower($this->__title)==strtolower("UC Browser"))
            $start="UC Browse";

        //Grab the browser version if its present
        if(preg_match('/'.$start.'[\ |\/]?([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
            $version=$regmatch[1];

        //Return browser Title and Version, but first..some titles need to be changed
        if(strtolower($this->__title)=="msie" && strtolower($version)=="7.0" && preg_match('/Trident\/4.0/i', $this->useragent))
            return " 8.0 (Compatibility Mode)"; //fix for IE8 quirky UA string with Compatibility Mode enabled
        elseif(strtolower($this->__title)=="msie")
                return " ".$version;
        elseif(strtolower($this->__title)=="multi-browser")
            return "Multi-Browser XP ".$version;
        elseif(strtolower($this->__title)=="nf-browser")
            return "NetFront ".$version;
        elseif(strtolower($this->__title)=="semc-browser")
            return "SEMC Browser ".$version;
        elseif(strtolower($this->__title)=="ucweb")
            return "UC Browser ".$version;
        elseif(strtolower($this->__title)=="up.browser" || strtolower($this->__title)=="up.link")
            return "Openwave Mobile Browser ".$version;
        elseif(strtolower($this->__title)=="chromeframe")
            return "Google Chrome Frame ".$version;
        elseif(strtolower($this->__title)=="mozilladeveloperpreview")
            return "Mozilla Developer Preview ".$version;
        elseif(strtolower($this->__title)=="multi-browser")
            return "Multi-Browser XP ".$version;
        elseif(strtolower($this->__title)=="opera mobi")
            return "Opera Mobile ".$version;
        elseif(strtolower($this->__title)=="osb-browser")
            return "Gtk+ WebCore ".$version;
        elseif(strtolower($this->__title)=="tablet browser")
            return "MicroB ".$version;
        elseif(strtolower($this->__title)=="tencenttraveler")
            return "TT Explorer ".$version;
        else
            return $this->__title." ".$version;
    }

/**
 * Detect Web Browser.
 *
 * @access private
 */
    private function detect_webbrowser(){
        $mobile=0;
        if(preg_match('/360se/i', $this->useragent)){
            $this->__link="http://se.360.cn/";
            $this->__title="360Safe Explorer";
            $this->__code="360se";
        }elseif(preg_match('/Abolimba/i', $this->useragent)){
            $this->__link="http://www.aborange.de/products/freeware/abolimba-multibrowser.php";
            $this->__title="Abolimba";
            $this->__code="abolimba";
        }elseif(preg_match('/ABrowse/i', $this->useragent)){
            $this->__link="http://abrowse.sourceforge.net/";
            $this->__title=$this->detect_browser_version("ABrowse");
            $this->__code="abrowse";
        }elseif(preg_match('/Acoo\ Browser/i', $this->useragent)){
            $this->__link="http://www.acoobrowser.com/";
            $this->__title="Acoo ".$this->detect_browser_version("Browser");
            $this->__code="acoobrowser";
        }elseif(preg_match('/Amaya/i', $this->useragent)){
            $this->__link="http://www.w3.org/Amaya/";
            $this->__title=$this->detect_browser_version("Amaya");
            $this->__code="amaya";
        }elseif(preg_match('/Amiga-AWeb/i', $this->useragent)){
            $this->__link="http://aweb.sunsite.dk/";
            $this->__title="Amiga ".$this->detect_browser_version("AWeb");
            $this->__code="amiga-aweb";
        }elseif(preg_match('/America\ Online\ Browser/i', $this->useragent)){
            $this->__link="http://downloads.channel.aol.com/browser";
            $this->__title="America Online ".$this->detect_browser_version("Browser");
            $this->__code="aol";
        }elseif(preg_match('/AmigaVoyager/i', $this->useragent)){
            $this->__link="http://v3.vapor.com/voyager/";
            $this->__title="Amiga ".$this->detect_browser_version("Voyager");
            $this->__code="amigavoyager";
        }elseif(preg_match('/AOL/i', $this->useragent)){
            $this->__link="http://downloads.channel.aol.com/browser";
            $this->__title=$this->detect_browser_version("AOL");
            $this->__code="aol";
        }elseif(preg_match('/Arora/i', $this->useragent)){
            $this->__link="http://code.google.com/p/arora/";
            $this->__title=$this->detect_browser_version("Arora");
            $this->__code="arora";
        }elseif(preg_match('/Avant\ Browser/i', $this->useragent)){
            $this->__link="http://www.avantbrowser.com/";
            $this->__title="Avant ".$this->detect_browser_version("Browser");
            $this->__code="avantbrowser";
        }elseif(preg_match('/Beonex/i', $this->useragent)){
            $this->__link="http://www.beonex.com/";
            $this->__title=$this->detect_browser_version("Beonex");
            $this->__code="beonex";
        }elseif(preg_match('/BlackBerry/i', $this->useragent)){
            $this->__link="http://www.blackberry.com/";
            $this->__title=$this->detect_browser_version("BlackBerry");
            $this->__code="blackberry";
        }elseif(preg_match('/Blackbird/i', $this->useragent)){
            $this->__link="http://www.blackbirdbrowser.com/";
            $this->__title=$this->detect_browser_version("Blackbird");
            $this->__code="blackbird";
        }elseif(preg_match('/BlackHawk/i', $this->useragent)){
            $this->__link="http://www.netgate.sk/blackhawk/help/welcome-to-blackhawk-web-browser.html";
            $this->__title=$this->detect_browser_version("BlackHawk");
            $this->__code="blackhawk";
        }elseif(preg_match('/Blazer/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Blazer_(web_browser)";
            $this->__title=$this->detect_browser_version("Blazer");
            $this->__code="blazer";
        }elseif(preg_match('/Bolt/i', $this->useragent)){
            $this->__link="http://www.boltbrowser.com/";
            $this->__title=$this->detect_browser_version("Bolt");
            $this->__code="bolt";
        }elseif(preg_match('/BonEcho/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/projects/minefield/";
            $this->__title=$this->detect_browser_version("BonEcho");
            $this->__code="firefoxdevpre";
        }elseif(preg_match('/BrowseX/i', $this->useragent)){
            $this->__link="http://pdqi.com/browsex/";
            $this->__title="BrowseX";
            $this->__code="browsex";
        }elseif(preg_match('/Browzar/i', $this->useragent)){
            $this->__link="http://www.browzar.com/";
            $this->__title=$this->detect_browser_version("Browzar");
            $this->__code="browzar";
        }elseif(preg_match('/Bunjalloo/i', $this->useragent)){
            $this->__link="http://code.google.com/p/quirkysoft/";
            $this->__title=$this->detect_browser_version("Bunjalloo");
            $this->__code="bunjalloo";
        }elseif(preg_match('/Camino/i', $this->useragent)){
            $this->__link="http://www.caminobrowser.org/";
            $this->__title=$this->detect_browser_version("Camino");
            $this->__code="camino";
        }elseif(preg_match('/Cayman\ Browser/i', $this->useragent)){
            $this->__link="http://www.caymanbrowser.com/";
            $this->__title="Cayman ".$this->detect_browser_version("Browser");
            $this->__code="caymanbrowser";
        }elseif(preg_match('/Cheshire/i', $this->useragent)){
            $this->__link="http://downloads.channel.aol.com/browser";
            $this->__title=$this->detect_browser_version("Cheshire");
            $this->__code="aol";
        }elseif(preg_match('/Chimera/i', $this->useragent)){
            $this->__link="http://www.chimera.org/";
            $this->__title=$this->detect_browser_version("Chimera");
            $this->__code="null";
        }elseif(preg_match('/chromeframe/i', $this->useragent)){
            $this->__link="http://code.google.com/chrome/chromeframe/";
            $this->__title=$this->detect_browser_version("chromeframe");
            $this->__code="google";
        }elseif(preg_match('/ChromePlus/i', $this->useragent)){
            $this->__link="http://www.chromeplus.org/";
            $this->__title=$this->detect_browser_version("ChromePlus");
            $this->__code="chromeplus";
        }elseif(preg_match('/Chrome/i', $this->useragent) && preg_match('/Iron/i', $this->useragent)){
            $this->__link="http://www.srware.net/";
            $this->__title="SRWare ".$this->detect_browser_version("Iron");
            $this->__code="srwareiron";
        }elseif(preg_match('/Chromium/i', $this->useragent)){
            $this->__link="http://www.chromium.org/";
            $this->__title=$this->detect_browser_version("Chromium");
            $this->__code="chromium";
        }elseif(preg_match('/CometBird/i', $this->useragent)){
            $this->__link="http://www.cometbird.com/";
            $this->__title=$this->detect_browser_version("CometBird");
            $this->__code="cometbird";
        }elseif(preg_match('/Comodo_Dragon/i', $this->useragent)){
            $this->__link="http://www.comodo.com/home/internet-security/browser.php";
            $this->__title="Comodo ".$this->detect_browser_version("Dragon");
            $this->__code="comodo-dragon";
        }elseif(preg_match('/Conkeror/i', $this->useragent)){
            $this->__link="http://www.conkeror.org/";
            $this->__title=$this->detect_browser_version("Conkeror");
            $this->__code="conkeror";
        }elseif(preg_match('/Crazy\ Browser/i', $this->useragent)){
            $this->__link="http://www.crazybrowser.com/";
            $this->__title="Crazy ".$this->detect_browser_version("Browser");
            $this->__code="crazybrowser";
        }elseif(preg_match('/Cruz/i', $this->useragent)){
            $this->__link="http://www.cruzapp.com/";
            $this->__title=$this->detect_browser_version("Cruz");
            $this->__code="cruz";
        }elseif(preg_match('/Cyberdog/i', $this->useragent)){
            $this->__link="http://www.cyberdog.org/about/cyberdog/cyberbrowse.html";
            $this->__title=$this->detect_browser_version("Cyberdog");
            $this->__code="cyberdog";
        }elseif(preg_match('/Deepnet\ Explorer/i', $this->useragent)){
            $this->__link="http://www.deepnetexplorer.com/";
            $this->__title=$this->detect_browser_version("Deepnet Explorer");
            $this->__code="deepnetexplorer";
        }elseif(preg_match('/Demeter/i', $this->useragent)){
            $this->__link="http://www.hurrikenux.com/Demeter/";
            $this->__title=$this->detect_browser_version("Demeter");
            $this->__code="demeter";
        }elseif(preg_match('/DeskBrowse/i', $this->useragent)){
            $this->__link="http://www.deskbrowse.org/";
            $this->__title=$this->detect_browser_version("DeskBrowse");
            $this->__code="deskbrowse";
        }elseif(preg_match('/Dillo/i', $this->useragent)){
            $this->__link="http://www.dillo.org/";
            $this->__title=$this->detect_browser_version("Dillo");
            $this->__code="dillo";
        }elseif(preg_match('/DoCoMo/i', $this->useragent)){
            $this->__link="http://www.nttdocomo.com/";
            $this->__title=$this->detect_browser_version("DoCoMo");
            $this->__code="null";
        }elseif(preg_match('/DocZilla/i', $this->useragent)){
            $this->__link="http://www.doczilla.com/";
            $this->__title=$this->detect_browser_version("DocZilla");
            $this->__code="doczilla";
        }elseif(preg_match('/Dolfin/i', $this->useragent)){
            $this->__link="http://www.samsungmobile.com/";
            $this->__title=$this->detect_browser_version("Dolfin");
            $this->__code="samsung";
        }elseif(preg_match('/Dooble/i', $this->useragent)){
            $this->__link="http://dooble.sourceforge.net/";
            $this->__title=$this->detect_browser_version("Dooble");
            $this->__code="dooble";
        }elseif(preg_match('/Doris/i', $this->useragent)){
            $this->__link="http://www.anygraaf.fi/browser/indexe.htm";
            $this->__title=$this->detect_browser_version("Doris");
            $this->__code="doris";
        }elseif(preg_match('/Edbrowse/i', $this->useragent)){
            $this->__link="http://edbrowse.sourceforge.net/";
            $this->__title=$this->detect_browser_version("Edbrowse");
            $this->__code="edbrowse";
        }elseif(preg_match('/Elinks/i', $this->useragent)){
            $this->__link="http://elinks.or.cz/";
            $this->__title=$this->detect_browser_version("Elinks");
            $this->__code="elinks";
        }elseif(preg_match('/Element\ Browser/i', $this->useragent)){
            $this->__link="http://www.elementsoftware.co.uk/software/elementbrowser/";
            $this->__title="Element ".$this->detect_browser_version("Browser");
            $this->__code="elementbrowser";
        }elseif(preg_match('/Enigma\ Browser/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Enigma_Browser";
            $this->__title="Enigma ".$this->detect_browser_version("Browser");
            $this->__code="enigmabrowser";
        }elseif(preg_match('/Epic/i', $this->useragent)){
            $this->__link="http://www.epicbrowser.com/";
            $this->__title=$this->detect_browser_version("Epic");
            $this->__code="epicbrowser";
        }elseif(preg_match('/Epiphany/i', $this->useragent)){
            $this->__link="http://gnome.org/projects/epiphany/";
            $this->__title=$this->detect_browser_version("Epiphany");
            $this->__code="epiphany";
        }elseif(preg_match('/Escape/i', $this->useragent)){
            $this->__link="http://www.espial.com/products/evo_browser/";
            $this->__title="Espial TV Browser - ".$this->detect_browser_version("Escape");
            $this->__code="espialtvbrowser";
        }elseif(preg_match('/Fennec/i', $this->useragent)){
            $this->__link="https://wiki.mozilla.org/Fennec";
            $this->__title=$this->detect_browser_version("Fennec");
            $this->__code="fennec";
        }elseif(preg_match('/Firebird/i', $this->useragent)){
            $this->__link="http://seb.mozdev.org/firebird/";
            $this->__title=$this->detect_browser_version("Firebird");
            $this->__code="firebird";
        }elseif(preg_match('/Flock/i', $this->useragent)){
            $this->__link="http://www.flock.com/";
            $this->__title=$this->detect_browser_version("Flock");
            $this->__code="flock";
        }elseif(preg_match('/Fluid/i', $this->useragent)){
            $this->__link="http://www.fluidapp.com/";
            $this->__title=$this->detect_browser_version("Fluid");
            $this->__code="fluid";
        }elseif(preg_match('/Galaxy/i', $this->useragent)){
            $this->__link="http://www.traos.org/";
            $this->__title=$this->detect_browser_version("Galaxy");
            $this->__code="galaxy";
        }elseif(preg_match('/Galeon/i', $this->useragent)){
            $this->__link="http://galeon.sourceforge.net/";
            $this->__title=$this->detect_browser_version("Galeon");
            $this->__code="galeon";
        }elseif(preg_match('/GlobalMojo/i', $this->useragent)){
            $this->__link="http://www.globalmojo.com/";
            $this->__title=$this->detect_browser_version("GlobalMojo");
            $this->__code="globalmojo";
        }elseif(preg_match('/GoBrowser/i', $this->useragent)){
            $this->__link="http://www.gobrowser.cn/";
            $this->__title="GO ".$this->detect_browser_version("Browser");
            $this->__code="gobrowser";
        }elseif(preg_match('/Google\ Wireless\ Transcoder/i', $this->useragent)){
            $this->__link="http://google.com/gwt/n";
            $this->__title="Google Wireless Transcoder";
            $this->__code="google";
        }elseif(preg_match('/GoSurf/i', $this->useragent)){
            $this->__link="http://gosurfbrowser.com/?ln=en";
            $this->__title=$this->detect_browser_version("GoSurf");
            $this->__code="gosurf";
        }elseif(preg_match('/GranParadiso/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/";
            $this->__title=$this->detect_browser_version("GranParadiso");
            $this->__code="firefoxdevpre";
        }elseif(preg_match('/GreenBrowser/i', $this->useragent)){
            $this->__link="http://www.morequick.com/";
            $this->__title=$this->detect_browser_version("GreenBrowser");
            $this->__code="greenbrowser";
        }elseif(preg_match('/Hana/i', $this->useragent)){
            $this->__link="http://www.alloutsoftware.com/";
            $this->__title=$this->detect_browser_version("Hana");
            $this->__code="hana";
        }elseif(preg_match('/HotJava/i', $this->useragent)){
            $this->__link="http://java.sun.com/products/archive/hotjava/";
            $this->__title=$this->detect_browser_version("HotJava");
            $this->__code="hotjava";
        }elseif(preg_match('/Hv3/i', $this->useragent)){
            $this->__link="http://tkhtml.tcl.tk/hv3.html";
            $this->__title=$this->detect_browser_version("Hv3");
            $this->__code="hv3";
        }elseif(preg_match('/Hydra\ Browser/i', $this->useragent)){
            $this->__link="http://www.hydrabrowser.com/";
            $this->__title="Hydra Browser";
            $this->__code="hydrabrowser";
        }elseif(preg_match('/Iris/i', $this->useragent)){
            $this->__link="http://www.torchmobile.com/";
            $this->__title=$this->detect_browser_version("Iris");
            $this->__code="iris";
        }elseif(preg_match('/IBM\ WebExplorer/i', $this->useragent)){
            $this->__link="http://www.networking.ibm.com/WebExplorer/";
            $this->__title="IBM ".$this->detect_browser_version("WebExplorer");
            $this->__code="ibmwebexplorer";
        }elseif(preg_match('/IBrowse/i', $this->useragent)){
            $this->__link="http://www.ibrowse-dev.net/";
            $this->__title=$this->detect_browser_version("IBrowse");
            $this->__code="ibrowse";
        }elseif(preg_match('/iCab/i', $this->useragent)){
            $this->__link="http://www.icab.de/";
            $this->__title=$this->detect_browser_version("iCab");
            $this->__code="icab";
        }elseif(preg_match('/Ice Browser/i', $this->useragent)){
            $this->__link="http://www.icesoft.com/products/icebrowser.html";
            $this->__title=$this->detect_browser_version("Ice Browser");
            $this->__code="icebrowser";
        }elseif(preg_match('/Iceape/i', $this->useragent)){
            $this->__link="http://packages.debian.org/iceape";
            $this->__title=$this->detect_browser_version("Iceape");
            $this->__code="iceape";
        }elseif(preg_match('/IceCat/i', $this->useragent)){
            $this->__link="http://gnuzilla.gnu.org/";
            $this->__title="GNU ".$this->detect_browser_version("IceCat");
            $this->__code="icecat";
        }elseif(preg_match('/IceWeasel/i', $this->useragent)){
            $this->__link="http://www.geticeweasel.org/";
            $this->__title=$this->detect_browser_version("IceWeasel");
            $this->__code="iceweasel";
        }elseif(preg_match('/IEMobile/i', $this->useragent)){
            $this->__link="http://www.microsoft.com/windowsmobile/en-us/downloads/microsoft/internet-explorer-mobile.mspx";
            $this->__title=$this->detect_browser_version("IEMobile");
            $this->__code="msie-mobile";
        }elseif(preg_match('/iNet\ Browser/i', $this->useragent)){
            $this->__link="http://alexanderjbeston.wordpress.com/";
            $this->__title="iNet ".$this->detect_browser_version("Browser");
            $this->__code="null";
        }elseif(preg_match('/iRider/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/IRider";
            $this->__title=$this->detect_browser_version("iRider");
            $this->__code="irider";
        }elseif(preg_match('/Iron/i', $this->useragent)){
            $this->__link="http://www.srware.net/en/software_srware_iron.php";
            $this->__title=$this->detect_browser_version("Iron");
            $this->__code="iron";
        }elseif(preg_match('/InternetSurfboard/i', $this->useragent)){
            $this->__link="http://inetsurfboard.sourceforge.net/";
            $this->__title=$this->detect_browser_version("InternetSurfboard");
            $this->__code="internetsurfboard";
        }elseif(preg_match('/Jasmine/i', $this->useragent)){
            $this->__link="http://www.samsungmobile.com/";
            $this->__title=$this->detect_browser_version("Jasmine");
            $this->__code="samsung";
        }elseif(preg_match('/K-Meleon/i', $this->useragent)){
            $this->__link="http://kmeleon.sourceforge.net/";
            $this->__title=$this->detect_browser_version("K-Meleon");
            $this->__code="kmeleon";
        }elseif(preg_match('/K-Ninja/i', $this->useragent)){
            $this->__link="http://k-ninja-samurai.en.softonic.com/";
            $this->__title=$this->detect_browser_version("K-Ninja");
            $this->__code="kninja";
        }elseif(preg_match('/Kapiko/i', $this->useragent)){
            $this->__link="http://ufoxlab.googlepages.com/cooperation";
            $this->__title=$this->detect_browser_version("Kapiko");
            $this->__code="kapiko";
        }elseif(preg_match('/Kazehakase/i', $this->useragent)){
            $this->__link="http://kazehakase.sourceforge.jp/";
            $this->__title=$this->detect_browser_version("Kazehakase");
            $this->__code="kazehakase";
        }elseif(preg_match('/Strata/i', $this->useragent)){
            $this->__link="http://www.kirix.com/";
            $this->__title="Kirix ".$this->detect_browser_version("Strata");
            $this->__code="kirix-strata";
        }elseif(preg_match('/KKman/i', $this->useragent)){
            $this->__link="http://www.kkman.com.tw/";
            $this->__title=$this->detect_browser_version("KKman");
            $this->__code="kkman";
        }elseif(preg_match('/KMail/i', $this->useragent)){
            $this->__link="http://kontact.kde.org/kmail/";
            $this->__title=$this->detect_browser_version("KMail");
            $this->__code="kmail";
        }elseif(preg_match('/KMLite/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/K-Meleon";
            $this->__title=$this->detect_browser_version("KMLite");
            $this->__code="kmeleon";
        }elseif(preg_match('/Konqueror/i', $this->useragent)){
            $this->__link="http://konqueror.kde.org/";
            $this->__title=$this->detect_browser_version("Konqueror");
            $this->__code="konqueror";
        }elseif(preg_match('/LBrowser/i', $this->useragent)){
            $this->__link="http://wiki.freespire.org/index.php/Web_Browser";
            $this->__title=$this->detect_browser_version("LBrowser");
            $this->__code="lbrowser";
        }elseif(preg_match('/LeechCraft/i', $this->useragent)){
            $this->__link="http://leechcraft.org/";
            $this->__title="LeechCraft";
            $this->__code="null";
        }elseif(preg_match('/Links/i', $this->useragent)){
            $this->__link="http://links.sourceforge.net/";
            $this->__title=$this->detect_browser_version("Links");
            $this->__code="links";
        }elseif(preg_match('/Lobo/i', $this->useragent)){
            $this->__link="http://www.lobobrowser.org/";
            $this->__title=$this->detect_browser_version("Lobo");
            $this->__code="lobo";
        }elseif(preg_match('/lolifox/i', $this->useragent)){
            $this->__link="http://www.lolifox.com/";
            $this->__title=$this->detect_browser_version("lolifox");
            $this->__code="lolifox";
        }elseif(preg_match('/Lorentz/i', $this->useragent)){
            $this->__link="http://news.softpedia.com/news/Firefox-Codenamed-Lorentz-Drops-in-March-2010-130855.shtml";
            $this->__title=$this->detect_browser_version("Lorentz");
            $this->__code="firefoxdevpre";
        }elseif(preg_match('/Lunascape/i', $this->useragent)){
            $this->__link="http://www.lunascape.tv";
            $this->__title=$this->detect_browser_version("Lunascape");
            $this->__code="lunascape";
        }elseif(preg_match('/Lynx/i', $this->useragent)){
            $this->__link="http://lynx.browser.org/";
            $this->__title=$this->detect_browser_version("Lynx");
            $this->__code="lynx";
        }elseif(preg_match('/Madfox/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Madfox";
            $this->__title=$this->detect_browser_version("Madfox");
            $this->__code="madfox";
        }elseif(preg_match('/Maemo\ Browser/i', $this->useragent)){
            $this->__link="http://maemo.nokia.com/features/maemo-browser/";
            $this->__title=$this->detect_browser_version("Maemo Browser");
            $this->__code="maemo";
        }elseif(preg_match('/Maxthon/i', $this->useragent)){
            $this->__link="http://www.maxthon.com/";
            $this->__title=$this->detect_browser_version("Maxthon");
            $this->__code="maxthon";
        }elseif(preg_match('/\ MIB\//i', $this->useragent)){
            $this->__link="http://www.motorola.com/content.jsp?globalObjectId=1827-4343";
            $this->__title=$this->detect_browser_version("MIB");
            $this->__code="mib";
        }elseif(preg_match('/Tablet\ browser/i', $this->useragent)){
            $this->__link="http://browser.garage.maemo.org/";
            $this->__title=$this->detect_browser_version("Tablet browser");
            $this->__code="microb";
        }elseif(preg_match('/Midori/i', $this->useragent)){
            $this->__link="http://www.twotoasts.de/index.php?/pages/midori_summary.html";
            $this->__title=$this->detect_browser_version("Midori");
            $this->__code="midori";
        }elseif(preg_match('/Minefield/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/projects/minefield/";
            $this->__title=$this->detect_browser_version("Minefield");
            $this->__code="minefield";
        }elseif(preg_match('/MiniBrowser/i', $this->useragent)){
            $this->__link="http://dmkho.tripod.com/";
            $this->__title=$this->detect_browser_version("MiniBrowser");
            $this->__code="minibrowser";
        }elseif(preg_match('/Minimo/i', $this->useragent)){
            $this->__link="http://www-archive.mozilla.org/projects/minimo/";
            $this->__title=$this->detect_browser_version("Minimo");
            $this->__code="minimo";
        }elseif(preg_match('/Mosaic/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Mosaic_(web_browser)";
            $this->__title=$this->detect_browser_version("Mosaic");
            $this->__code="mosaic";
        }elseif(preg_match('/MozillaDeveloperPreview/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/projects/devpreview/releasenotes/";
            $this->__title=$this->detect_browser_version("MozillaDeveloperPreview");
            $this->__code="firefoxdevpre";
        }elseif(preg_match('/Multi-Browser/i', $this->useragent)){
            $this->__link="http://www.multibrowser.de/";
            $this->__title=$this->detect_browser_version("Multi-Browser");
            $this->__code="multi-browserxp";
        }elseif(preg_match('/MultiZilla/i', $this->useragent)){
            $this->__link="http://multizilla.mozdev.org/";
            $this->__title=$this->detect_browser_version("MultiZilla");
            $this->__code="mozilla";
        }elseif(preg_match('/myibrow/i', $this->useragent) && preg_match('/My\ Internet\ Browser/i', $this->useragent)){
            $this->__link="http://myinternetbrowser.webove-stranky.org/";
            $this->__title=$this->detect_browser_version("myibrow");
            $this->__code="my-internet-browser";
        }elseif(preg_match('/MyIE2/i', $this->useragent)){
            $this->__link="http://www.myie2.com/";
            $this->__title=$this->detect_browser_version("MyIE2");
            $this->__code="myie2";
        }elseif(preg_match('/Namoroka/i', $this->useragent)){
            $this->__link="https://wiki.mozilla.org/Firefox/Namoroka";
            $this->__title=$this->detect_browser_version("Namoroka");
            $this->__code="firefoxdevpre";
        }elseif(preg_match('/Navigator/i', $this->useragent)){
            $this->__link="http://netscape.aol.com/";
            $this->__title="Netscape ".$this->detect_browser_version("Navigator");
            $this->__code="netscape";
        }elseif(preg_match('/NetBox/i', $this->useragent)){
            $this->__link="http://www.netgem.com/";
            $this->__title=$this->detect_browser_version("NetBox");
            $this->__code="netbox";
        }elseif(preg_match('/NetCaptor/i', $this->useragent)){
            $this->__link="http://www.netcaptor.com/";
            $this->__title=$this->detect_browser_version("NetCaptor");
            $this->__code="netcaptor";
        }elseif(preg_match('/NetFront/i', $this->useragent)){
            $this->__link="http://www.access-company.com/";
            $this->__title=$this->detect_browser_version("NetFront");
            $this->__code="netfront";
        }elseif(preg_match('/NetNewsWire/i', $this->useragent)){
            $this->__link="http://www.newsgator.com/individuals/netnewswire/";
            $this->__title=$this->detect_browser_version("NetNewsWire");
            $this->__code="netnewswire";
        }elseif(preg_match('/NetPositive/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/NetPositive";
            $this->__title=$this->detect_browser_version("NetPositive");
            $this->__code="netpositive";
        }elseif(preg_match('/Netscape/i', $this->useragent)){
            $this->__link="http://netscape.aol.com/";
            $this->__title=$this->detect_browser_version("Netscape");
            $this->__code="netscape";
        }elseif(preg_match('/NetSurf/i', $this->useragent)){
            $this->__link="http://www.netsurf-browser.org/";
            $this->__title=$this->detect_browser_version("NetSurf");
            $this->__code="netsurf";
        }elseif(preg_match('/NF-Browser/i', $this->useragent)){
            $this->__link="http://www.access-company.com/";
            $this->__title=$this->detect_browser_version("NF-Browser");
            $this->__code="netfront";
        }elseif(preg_match('/Novarra-Vision/i', $this->useragent)){
            $this->__link="http://www.novarra.com/";
            $this->__title="Novarra ".$this->detect_browser_version("Vision");
            $this->__code="novarra";
        }elseif(preg_match('/Obigo/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Obigo_Browser";
            $this->__title=$this->detect_browser_version("Obigo");
            $this->__code="obigo";
        }elseif(preg_match('/OffByOne/i', $this->useragent)){
            $this->__link="http://www.offbyone.com/";
            $this->__title="Off By One";
            $this->__code="offbyone";
        }elseif(preg_match('/OmniWeb/i', $this->useragent)){
            $this->__link="http://www.omnigroup.com/applications/omniweb/";
            $this->__title=$this->detect_browser_version("OmniWeb");
            $this->__code="omniweb";
        }elseif(preg_match('/Opera Mini/i', $this->useragent)){
            $this->__link="http://www.opera.com/mini/";
            $this->__title=$this->detect_browser_version("Opera Mini");
            $this->__code="opera-2";
        }elseif(preg_match('/Opera Mobi/i', $this->useragent)){
            $this->__link="http://www.opera.com/mobile/";
            $this->__title=$this->detect_browser_version("Opera Mobi");
            $this->__code="opera-2";
        }elseif(preg_match('/Opera Next/i', $this->useragent)){
            $this->__link="http://www.opera.com/support/kb/view/991/";
            $this->__title=$this->detect_browser_version("Opera Next");
            $this->__code="opera-next";
        }elseif(preg_match('/Opera/i', $this->useragent)){
            $this->__link="http://www.opera.com/";
            $this->__title=$this->detect_browser_version("Opera");
            $this->__code="opera-1";
            if(preg_match('/Version/i', $this->useragent))
                $this->__code="opera-2";
        }elseif(preg_match('/Orca/i', $this->useragent)){
            $this->__link="http://www.orcabrowser.com/";
            $this->__title=$this->detect_browser_version("Orca");
            $this->__code="orca";
        }elseif(preg_match('/Oregano/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Oregano_(web_browser)";
            $this->__title=$this->detect_browser_version("Oregano");
            $this->__code="oregano";
        }elseif(preg_match('/Origyn\ Web\ Browser/i', $this->useragent)){
            $this->__link="http://www.sand-labs.org/owb";
            $this->__title="Oregano Web Browser";
            $this->__code="owb";
        }elseif(preg_match('/osb-browser/i', $this->useragent)){
            $this->__link="http://gtk-webcore.sourceforge.net/";
            $this->__title=$this->detect_browser_version("osb-browser");
            $this->__code="null";
        }elseif(preg_match('/\ Pre\//i', $this->useragent)){
            $this->__link="http://www.palm.com/us/products/phones/pre/index.html";
            $this->__title="Palm ".$this->detect_browser_version("Pre");
            $this->__code="palmpre";
        }elseif(preg_match('/Palemoon/i', $this->useragent)){
            $this->__link="http://www.palemoon.org/";
            $this->__title="Pale ".$this->detect_browser_version("Moon");
            $this->__code="palemoon";
        }elseif(preg_match('/Phaseout/i', $this->useragent)){
            $this->__link="http://www.phaseout.net/";
            $this->__title="Phaseout";
            $this->__code="phaseout";
        }elseif(preg_match('/Phoenix/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/projects/phoenix/phoenix-release-notes.html";
            $this->__title=$this->detect_browser_version("Phoenix");
            $this->__code="phoenix";
        }elseif(preg_match('/Pogo/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/AT%26T_Pogo";
            $this->__title=$this->detect_browser_version("Pogo");
            $this->__code="pogo";
        }elseif(preg_match('/Polaris/i', $this->useragent)){
            $this->__link="http://www.infraware.co.kr/eng/01_product/product02.asp";
            $this->__title=$this->detect_browser_version("Polaris");
            $this->__code="polaris";
        }elseif(preg_match('/Prism/i', $this->useragent)){
            $this->__link="http://prism.mozillalabs.com/";
            $this->__title=$this->detect_browser_version("Prism");
            $this->__code="prism";
        }elseif(preg_match('/QtWeb\ Internet\ Browser/i', $this->useragent)){
            $this->__link="http://www.qtweb.net/";
            $this->__title="QtWeb Internet ".$this->detect_browser_version("Browser");
            $this->__code="qtwebinternetbrowser";
        }elseif(preg_match('/rekonq/i', $this->useragent)){
            $this->__link="http://rekonq.sourceforge.net/";
            $this->__title="rekonq";
            $this->__code="rekonq";
        }elseif(preg_match('/retawq/i', $this->useragent)){
            $this->__link="http://retawq.sourceforge.net/";
            $this->__title=$this->detect_browser_version("retawq");
            $this->__code="terminal";
        }elseif(preg_match('/RockMelt/i', $this->useragent)){
            $this->__link="http://www.rockmelt.com/";
            $this->__title=$this->detect_browser_version("RockMelt");
            $this->__code="rockmelt";
        }elseif(preg_match('/SaaYaa/i', $this->useragent)){
            $this->__link="http://www.saayaa.com/";
            $this->__title="SaaYaa Explorer";
            $this->__code="saayaa";
        }elseif(preg_match('/SeaMonkey/i', $this->useragent)){
            $this->__link="http://www.seamonkey-project.org/";
            $this->__title=$this->detect_browser_version("SeaMonkey");
            $this->__code="seamonkey";
        }elseif(preg_match('/SEMC-Browser/i', $this->useragent)){
            $this->__link="http://www.sonyericsson.com/";
            $this->__title=$this->detect_browser_version("SEMC-Browser");
            $this->__code="semcbrowser";
        }elseif(preg_match('/SEMC-java/i', $this->useragent)){
            $this->__link="http://www.sonyericsson.com/";
            $this->__title=$this->detect_browser_version("SEMC-java");
            $this->__code="semcbrowser";
        }elseif(preg_match('/Series60/i', $this->useragent) && !preg_match('/Symbian/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Web_Browser_for_S60";
            $this->__title="Nokia ".$this->detect_browser_version("Series60");
            $this->__code="s60";
        }elseif(preg_match('/S60/i', $this->useragent) && !preg_match('/Symbian/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Web_Browser_for_S60";
            $this->__title="Nokia ".$this->detect_browser_version("S60");
            $this->__code="s60";
        }elseif(preg_match('/SE\ /i', $this->useragent) && preg_match('/MetaSr/i', $this->useragent)){
            $this->__link="http://ie.sogou.com/";
            $this->__title="Sogou Explorer";
            $this->__code="sogou";
        }elseif(preg_match('/Shiira/i', $this->useragent)){
            $this->__link="http://www.shiira.jp/en.php";
            $this->__title=$this->detect_browser_version("Shiira");
            $this->__code="shiira";
        }elseif(preg_match('/Shiretoko/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/";
            $this->__title=$this->detect_browser_version("Shiretoko");
            $this->__code="firefoxdevpre";
        }elseif(preg_match('/SiteKiosk/i', $this->useragent)){
            $this->__link="http://www.sitekiosk.com/SiteKiosk/Default.aspx";
            $this->__title=$this->detect_browser_version("SiteKiosk");
            $this->__code="sitekiosk";
        }elseif(preg_match('/SkipStone/i', $this->useragent)){
            $this->__link="http://www.muhri.net/skipstone/";
            $this->__title=$this->detect_browser_version("SkipStone");
            $this->__code="skipstone";
        }elseif(preg_match('/Skyfire/i', $this->useragent)){
            $this->__link="http://www.skyfire.com/";
            $this->__title=$this->detect_browser_version("Skyfire");
            $this->__code="skyfire";
        }elseif(preg_match('/Sleipnir/i', $this->useragent)){
            $this->__link="http://www.fenrir-inc.com/other/sleipnir/";
            $this->__title=$this->detect_browser_version("Sleipnir");
            $this->__code="sleipnir";
        }elseif(preg_match('/SlimBrowser/i', $this->useragent)){
            $this->__link="http://www.flashpeak.com/sbrowser/";
            $this->__title=$this->detect_browser_version("SlimBrowser");
            $this->__code="slimbrowser";
        }elseif(preg_match('/Songbird/i', $this->useragent)){
            $this->__link="http://www.getsongbird.com/";
            $this->__title=$this->detect_browser_version("Songbird");
            $this->__code="songbird";
        }elseif(preg_match('/Stainless/i', $this->useragent)){
            $this->__link="http://www.stainlessapp.com/";
            $this->__title=$this->detect_browser_version("Stainless");
            $this->__code="stainless";
        }elseif(preg_match('/Sulfur/i', $this->useragent)){
            $this->__link="http://www.flock.com/";
            $this->__title="Flock ".$this->detect_browser_version("Sulfur");
            $this->__code="flock";
        }elseif(preg_match('/Sunrise/i', $this->useragent)){
            $this->__link="http://www.sunrisebrowser.com/";
            $this->__title=$this->detect_browser_version("Sunrise");
            $this->__code="sunrise";
        }elseif(preg_match('/Surf/i', $this->useragent)){
            $this->__link="http://surf.suckless.org/";
            $this->__title=$this->detect_browser_version("Surf");
            $this->__code="surf";
        }elseif(preg_match('/Swiftfox/i', $this->useragent)){
            $this->__link="http://www.getswiftfox.com/";
            $this->__title=$this->detect_browser_version("Swiftfox");
            $this->__code="swiftfox";
        }elseif(preg_match('/Swiftweasel/i', $this->useragent)){
            $this->__link="http://swiftweasel.tuxfamily.org/";
            $this->__title=$this->detect_browser_version("Swiftweasel");
            $this->__code="swiftweasel";
        }elseif(preg_match('/tear/i', $this->useragent)){
            $this->__link="http://wiki.maemo.org/Tear";
            $this->__title="Tear";
            $this->__code="tear";
        }elseif(preg_match('/TeaShark/i', $this->useragent)){
            $this->__link="http://www.teashark.com/";
            $this->__title=$this->detect_browser_version("TeaShark");
            $this->__code="teashark";
        }elseif(preg_match('/Teleca/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Obigo_Browser/";
            $this->__title=$this->detect_browser_version(" Teleca");
            $this->__code="obigo";
        }elseif(preg_match('/TencentTraveler/i', $this->useragent)){
            $this->__link="http://www.tencent.com/en-us/index.shtml";
            $this->__title="Tencent ".$this->detect_browser_version("Traveler");
            $this->__code="tencenttraveler";
        }elseif(preg_match('/TheWorld/i', $this->useragent)){
            $this->__link="http://www.ioage.com/";
            $this->__title="TheWorld Browser";
            $this->__code="theworld";
        }elseif(preg_match('/Thunderbird/i', $this->useragent)){
            $this->__link="http://www.mozilla.com/thunderbird/";
            $this->__title=$this->detect_browser_version("Thunderbird");
            $this->__code="thunderbird";
        }elseif(preg_match('/Tjusig/i', $this->useragent)){
            $this->__link="http://www.tjusig.cz/";
            $this->__title=$this->detect_browser_version("Tjusig");
            $this->__code="tjusig";
        }elseif(preg_match('/TencentTraveler/i', $this->useragent)){
            $this->__link="http://tt.qq.com/";
            $this->__title=$this->detect_browser_version("TencentTraveler");
            $this->__code="tt-explorer";
        }elseif(preg_match('/uBrowser/i', $this->useragent)){
            $this->__link="http://www.ubrowser.com/";
            $this->__title=$this->detect_browser_version("uBrowser");
            $this->__code="ubrowser";
        }elseif(preg_match('/UC\ Browser/i', $this->useragent)){
            $this->__link="http://www.uc.cn/English/index.shtml";
            $this->__title=$this->detect_browser_version("UC Browser");
            $this->__code="ucbrowser";
        }elseif(preg_match('/UCWEB/i', $this->useragent)){
            $this->__link="http://www.ucweb.com/English/product.shtml";
            $this->__title=$this->detect_browser_version("UCWEB");
            $this->__code="ucweb";
        }elseif(preg_match('/UltraBrowser/i', $this->useragent)){
            $this->__link="http://www.ultrabrowser.com/";
            $this->__title=$this->detect_browser_version("UltraBrowser");
            $this->__code="ultrabrowser";
        }elseif(preg_match('/UP.Browser/i', $this->useragent)){
            $this->__link="http://www.openwave.com/";
            $this->__title=$this->detect_browser_version("UP.Browser");
            $this->__code="openwave";
        }elseif(preg_match('/UP.Link/i', $this->useragent)){
            $this->__link="http://www.openwave.com/";
            $this->__title=$this->detect_browser_version("UP.Link");
            $this->__code="openwave";
        }elseif(preg_match('/uZardWeb/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/UZard_Web";
            $this->__title=$this->detect_browser_version("uZardWeb");
            $this->__code="uzardweb";
        }elseif(preg_match('/uZard/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/UZard_Web";
            $this->__title=$this->detect_browser_version("uZard");
            $this->__code="uzardweb";
        }elseif(preg_match('/uzbl/i', $this->useragent)){
            $this->__link="http://www.uzbl.org/";
            $this->__title="uzbl";
            $this->__code="uzbl";
        }elseif(preg_match('/Vimprobable/i', $this->useragent)){
            $this->__link="http://www.vimprobable.org/";
            $this->__title=$this->detect_browser_version("Vimprobable");
            $this->__code="null";
        }elseif(preg_match('/Vonkeror/i', $this->useragent)){
            $this->__link="http://zzo38computer.cjb.net/vonkeror/";
            $this->__title=$this->detect_browser_version("Vonkeror");
            $this->__code="null";
        }elseif(preg_match('/w3m/i', $this->useragent)){
            $this->__link="http://w3m.sourceforge.net/";
            $this->__title=$this->detect_browser_version("W3M");
            $this->__code="w3m";
        }elseif(preg_match('/AppleWebkitBrowser/i', $this->useragent) && preg_match('/Android/i', $this->useragent)){
            $this->__link="http://developer.android.com/reference/android/webkit/package-summary.html";
            $this->__title=$this->detect_browser_version("Android Webkit");
            $this->__code="android-webkit";
        }elseif(preg_match('/WeltweitimnetzBrowser/i', $this->useragent)){
            $this->__link="http://weltweitimnetz.de/software/Browser.en.page";
            $this->__title="Weltweitimnetz ".$this->detect_browser_version("Browser");
            $this->__code="weltweitimnetzbrowser";
        }elseif(preg_match('/wKiosk/i', $this->useragent)){
            $this->__link="http://www.app4mac.com/store/index.php?target=products&product_id=9";
            $this->__title="wKiosk";
            $this->__code="wkiosk";
        }elseif(preg_match('/WorldWideWeb/i', $this->useragent)){
            $this->__link="http://www.w3.org/People/Berners-Lee/WorldWideWeb.html";
            $this->__title=$this->detect_browser_version("WorldWideWeb");
            $this->__code="worldwideweb";
        }elseif(preg_match('/Wyzo/i', $this->useragent)){
            $this->__link="http://www.wyzo.com/";
            $this->__title=$this->detect_browser_version("Wyzo");
            $this->__code="Wyzo";
        }elseif(preg_match('/X-Smiles/i', $this->useragent)){
            $this->__link="http://www.xsmiles.org/";
            $this->__title=$this->detect_browser_version("X-Smiles");
            $this->__code="x-smiles";
        }elseif(preg_match('/Xiino/i', $this->useragent)){
            $this->__link="#";
            $this->__title=$this->detect_browser_version("Xiino");
            $this->__code="null";

        //Pulled out of order to help ensure better detection for above browsers
        }elseif(preg_match('/Chrome/i', $this->useragent)){
            $this->__link="http://google.com/chrome/";
            $this->__title="Google ".$this->detect_browser_version("Chrome");
            $this->__code="chrome";
        }elseif(preg_match('/Safari/i', $this->useragent) && !preg_match('/Nokia/i', $this->useragent)){
            $this->__link="http://www.apple.com/safari/";
            $this->__title="Safari";
            if(preg_match('/Version/i', $this->useragent))
                $this->__title=$this->detect_browser_version("Safari");
            if(preg_match('/Mobile Safari/i', $this->useragent))
                $this->__title="Mobile ".$this->__title;
            $this->__code="safari";
        }elseif(preg_match('/Nokia/i', $this->useragent)){
            $this->__link="http://www.nokia.com/browser";
            $this->__title="Nokia Web Browser";
            $this->__code="maemo"; 
        }elseif(preg_match('/Firefox/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/";
            $this->__title=$this->detect_browser_version("Firefox");
            $this->__code="firefox";
        }elseif(preg_match('/MSIE/i', $this->useragent)){
            $this->__link="http://www.microsoft.com/windows/products/winfamily/ie/default.mspx";
            $this->__title="Internet Explorer".$this->detect_browser_version("MSIE");
            preg_match('/MSIE[\ |\/]?([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch);
            if($regmatch[1]>=9){
                $this->__code="msie9";
            }elseif($regmatch[1]>=7){
                //also ie8
                $this->__code="msie7";
            }elseif($regmatch[1]>=6){
                $this->__code="msie6";
            }elseif($regmatch[1]>=4){
                //also ie5
                $this->__code="msie4";
            }elseif($regmatch[1]>=3){
                $this->__code="msie3";
            }elseif($regmatch[1]>=2){
                $this->__code="msie2";
            }elseif($regmatch[1]>=1){
                $this->__code="msie1";
            }else{
                $this->__code="msie";
            }
        }elseif(preg_match('/Mozilla/i', $this->useragent)){
            $this->__link="http://www.mozilla.org/";
            $this->__title="Mozilla Compatible";
            if(preg_match('/rv:([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title="Mozilla ".$regmatch[1];
            $this->__code="mozilla";
        }else{
            $this->__link="#";
            $this->__title="Unknown";
            $this->__code=null;
        }        
    }
    
/**
 * Returns Browser Icon.
 *
 * @param string optional User Agent.
 * @return string Web Browser Icon Image HTML
 * @access public
 */
    public function browser($useragent = null) {
        if($useragent!==null) $this->useragent = $useragent;
        $this->detect_webbrowser();
        return $this->Html->image('/user_agent/img/16/net/'.$this->__code.'.png', array('alt' => $this->__title));
    }

/**
 * Detect Console or Mobile Device.
 *
 * @access private
 */
    private function detect_device(){
        //Apple
        if(preg_match('/iPad/i', $this->useragent)){
            $this->__link="http://www.apple.com/itunes";
            $this->__title="iPad";
            if(preg_match('/CPU\ OS\ ([._0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" iOS ".str_replace("_", ".", $regmatch[1]);
            $this->__code="ipad";
        }elseif(preg_match('/iPod/i', $this->useragent)){
            $this->__link="http://www.apple.com/itunes";
            $this->__title="iPod";
            if(preg_match('/iPhone\ OS\ ([._0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" iOS ".str_replace("_", ".", $regmatch[1]);
            $this->__code="iphone";
        }elseif(preg_match('/iPhone/i', $this->useragent)){
            $this->__link="http://www.apple.com/iphone";
            $this->__title="iPhone";
            if(preg_match('/iPhone\ OS\ ([._0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" iOS ".str_replace("_", ".", $regmatch[1]);
            $this->__code="iphone";

        //BenQ-Siemens (Openwave)
        }elseif(preg_match('/[^M]SIE/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/BenQ-Siemens";
            $this->__title="BenQ-Siemens";
            if(preg_match('/[^M]SIE-([.0-9a-zA-Z]+)\//i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="benq-siemens";

        //BlackBerry
        }elseif(preg_match('/BlackBerry/i', $this->useragent)){
            $this->__link="http://www.blackberry.com/";
            $this->__title="BlackBerry";
            if(preg_match('/blackberry([.0-9a-zA-Z]+)\//i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="blackberry";

        //Dell
        }elseif(preg_match('/Dell Mini 5/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Dell_Streak";
            $this->__title="Dell Mini 5";
            $this->__code="dell";
        }elseif(preg_match('/Dell Streak/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Dell_Streak";
            $this->__title="Dell Streak";
            $this->__code="dell";
        }elseif(preg_match('/Dell/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Dell";
            $this->__title="Dell";
            $this->__code="dell";

        //Google
        }elseif(preg_match('/Nexus One/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Nexus_One";
            $this->__title="Nexus One";
            $this->__code="google-nexusone";

        //HTC
        }elseif(preg_match('/Desire/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/HTC_Desire";
            $this->__title="HTC Desire";
            $this->__code="htc";
        }elseif(preg_match('/Rhodium/i', $this->useragent) || preg_match('/HTC[_|\ ]Touch[_|\ ]Pro2/i', $this->useragent) || preg_match('/WMD-50433/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/HTC_Touch_Pro2";
            $this->__title="HTC Touch Pro2";
            $this->__code="htc";
        }elseif(preg_match('/HTC[_|\ ]Touch[_|\ ]Pro/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/HTC_Touch_Pro";
            $this->__title="HTC Touch Pro";
            $this->__code="htc";
        }elseif(preg_match('/HTC/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/High_Tech_Computer_Corporation";
            $this->__title="HTC";
            if(preg_match('/HTC[\ |_|-]8500/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_Startrek";
                $this->__title.=" Startrek";
            }elseif(preg_match('/HTC[\ |_|-]Hero/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_Hero";
                $this->__title.=" Hero";
            }elseif(preg_match('/HTC[\ |_|-]Legend/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_Legend";
                $this->__title.=" Legend";
            }elseif(preg_match('/HTC[\ |_|-]Magic/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_Magic";
                $this->__title.=" Magic";
            }elseif(preg_match('/HTC[\ |_|-]P3450/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_Touch";
                $this->__title.=" Touch";
            }elseif(preg_match('/HTC[\ |_|-]P3650/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_Polaris";
                $this->__title.=" Polaris";
            }elseif(preg_match('/HTC[\ |_|-]S710/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_S710";
                $this->__title.=" S710";
            }elseif(preg_match('/HTC[\ |_|-]Tattoo/i', $this->useragent)){
                $this->__link="http://en.wikipedia.org/wiki/HTC_Tattoo";
                $this->__title.=" Tattoo";
            }elseif(preg_match('/HTC[\ |_|-]?([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch)){
                $this->__title.=" ".$regmatch[1];
            }elseif(preg_match('/HTC([._0-9a-zA-Z]+)/i', $this->useragent, $regmatch)){
                $this->__title.=str_replace("_", " ", $regmatch[1]);
            }
            $this->__code="htc";

        //Kindle
        }elseif(preg_match('/Kindle/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Amazon_Kindle";
            $this->__title="Kindle";
            if(preg_match('/Kindle\/([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="kindle";

        //LG
        }elseif(preg_match('/LG/i', $this->useragent)){
            $this->__link="http://www.lgmobile.com";
            $this->__title="LG";
            if(preg_match('/LG[E]?[\ |-|\/]([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="lg";

        //Motorola
        }elseif(preg_match('/\ Droid/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Motorola_Droid";
            $this->__title.="Motorola Droid";
            $this->__code="motorola";
        }elseif(preg_match('/XT720/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Motorola";
            $this->__title.="Motorola Motoroi (XT720)";
            $this->__code="motorola";
        }elseif(preg_match('/MOT-/i', $this->useragent) || preg_match('/MIB/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Motorola";
            $this->__title="Motorola";
            if(preg_match('/MOTO([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            if(preg_match('/MOT-([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="motorola";

        //Nintendo
        }elseif(preg_match('/Nintendo/i', $this->useragent)){
            $this->__title="Nintendo";
            if(preg_match('/Nintendo DSi/i', $this->useragent)){
                $this->__link="http://www.nintendodsi.com/";
                $this->__title.=" DSi";
                $this->__code="nintendodsi";
            }elseif(preg_match('/Nintendo DS/i', $this->useragent)){
                $this->__link="http://www.nintendo.com/ds";
                $this->__title.=" DS";
                $this->__code="nintendods";
            }elseif(preg_match('/Nintendo Wii/i', $this->useragent)){
                $this->__link="http://www.nintendo.com/wii";
                $this->__title.=" Wii";
                $this->__code="nintendowii";
            }else{
                $this->__link="http://www.nintendo.com/";
                $this->__code="nintendo";
            }

        //Nokia
        }elseif(preg_match('/Nokia/i', $this->useragent) && !preg_match('/S(eries)?60/i', $this->useragent)){
            $this->__link="http://www.nokia.com/";
            $this->__title="Nokia";
            if(preg_match('/Nokia(E|N)?([0-9]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1].$regmatch[2];
            $this->__code="nokia";
        }elseif(preg_match('/S(eries)?60/i', $this->useragent)){
            $this->__link="http://www.s60.com";
            $this->__title="Nokia Series60";
            $this->__code="nokia";

        //OLPC (One Laptop Per Child)
        }elseif(preg_match('/OLPC/i', $this->useragent)){
            $this->__link="http://www.laptop.org/";
            $this->__title="OLPC (XO)";
            $this->__code="olpc";

        //Palm
        }elseif(preg_match('/\ Pixi\//i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Palm_Pixi";
            $this->__title="Palm Pixi";
            $this->__code="palm";
        }elseif(preg_match('/\ Pre\//i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Palm_Pre";
            $this->__title="Palm Pre";
            $this->__code="palm";
        }elseif(preg_match('/Palm/i', $this->useragent)){
            $this->__link="http://www.palm.com/";
            $this->__title="Palm";
            $this->__code="palm";

        //Playstation
        }elseif(preg_match('/Playstation/i', $this->useragent)){
            $this->__title="Playstation";
            if(preg_match('/[PS|Playstation\ ]3/i', $this->useragent)){
                $this->__link="http://www.us.playstation.com/PS3";
                $this->__title.=" 3";
            }elseif(preg_match('/[Playstation Portable|PSP]/i', $this->useragent)){
                $this->__link="http://www.us.playstation.com/PSP";
                $this->__title.=" Portable";
            }else{
                $this->__link="http://www.us.playstation.com/";
            }
            $this->__code="playstation";

        //Samsung
        }elseif(preg_match('/Samsung/i', $this->useragent)){
            $this->__link="http://www.samsungmobile.com/";
            $this->__title="Samsung";
            if(preg_match('/Samsung-([.\-0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="samsung";

        //Sony Ericsson
        }elseif(preg_match('/SonyEricsson/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/SonyEricsson";
            $this->__title="SonyEricsson";
            if(preg_match('/SonyEricsson([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch)){
                if(strtolower($regmatch[1])==strtolower("U20i"))
                    $this->__title.=" Xperia X10 Mini Pro";
                else
                    $this->__title.=" ".$regmatch[1];
            }
            $this->__code="sonyericsson";
        }
    }

    private function detect_os(){
        $version = '';
        if(preg_match('/AmigaOS/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/AmigaOS";
            $this->__title="AmigaOS";
            if(preg_match('/AmigaOS\ ([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="amigaos";
        }elseif(preg_match('/Android/i', $this->useragent)){
            $this->__link="http://www.android.com/";
            $this->__title="Android";
            $this->__code="android";
        }elseif(preg_match('/[^A-Za-z]Arch/i', $this->useragent)) { //&& !preg_match('/Search/i', $this->useragent)){
            $this->__link="http://www.archlinux.org/";
            $this->__title="Arch Linux";
            $this->__code="archlinux";
        }elseif(preg_match('/BeOS/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/BeOS";
            $this->__title="BeOS";
            $this->__code="beos";
        }elseif(preg_match('/CentOS/i', $this->useragent)){
            $this->__link="http://www.centos.org/";
            $this->__title="CentOS";
            if(preg_match('/.el([.0-9a-zA-Z]+).centos/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="centos";
        }elseif(preg_match('/CrOS/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Google_Chrome_OS";
            $this->__title="Google Chrome OS";
            $this->__code="chromeos";
        }elseif(preg_match('/Debian/i', $this->useragent)){
            $this->__link="http://www.debian.org/";
            $this->__title="Debian GNU/Linux";
            $this->__code="debian";
        }elseif(preg_match('/DragonFly/i', $this->useragent)){
            $this->__link="http://www.dragonflybsd.org/";
            $this->__title="DragonFly BSD";
            $this->__code="dragonflybsd";
        }elseif(preg_match('/Edubuntu/i', $this->useragent)){
            $this->__link="http://www.edubuntu.org/";
            $this->__title="Edubuntu";
            if(preg_match('/Edubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $version.=" ".$regmatch[1];
            if($regmatch[1] < 10)
                $this->__code="edubuntu-1";
            else
                $this->__code="edubuntu-2";
            if(strlen($version) > 1)
                $this->__title.=$version;
        }elseif(preg_match('/Fedora/i', $this->useragent)){
            $this->__link="http://www.fedoraproject.org/";
            $this->__title="Fedora";
            if(preg_match('/.fc([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="fedora";
        }elseif(preg_match('/Foresight\ Linux/i', $this->useragent)){
            $this->__link="http://www.foresightlinux.org/";
            $this->__title="Foresight Linux";
            if(preg_match('/Foresight\ Linux\/([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="foresight";
        }elseif(preg_match('/FreeBSD/i', $this->useragent)){
            $this->__link="http://www.freebsd.org/";
            $this->__title="FreeBSD";
            $this->__code="freebsd";
        }elseif(preg_match('/Gentoo/i', $this->useragent)){
            $this->__link="http://www.gentoo.org/";
            $this->__title="Gentoo";
            $this->__code="gentoo";
        }elseif(preg_match('/IRIX/i', $this->useragent)){
            $this->__link="http://www.sgi.com/partners/?/technology/irix/";
            $this->__title="IRIX Linux";
            if(preg_match('/IRIX(64)?\ ([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch)) {
                if($regmatch[1])
                    $this->__title.=" x".$regmatch[1];
                if($regmatch[2])
                    $this->__title.=" ".$regmatch[2];
            }
            $this->__code="irix";
        }elseif(preg_match('/Kanotix/i', $this->useragent)){
            $this->__link="http://www.kanotix.com/";
            $this->__title="Kanotix";
            $this->__code="kanotix";
        }elseif(preg_match('/Knoppix/i', $this->useragent)){
            $this->__link="http://www.knoppix.net/";
            $this->__title="Knoppix";
            $this->__code="knoppix";
        }elseif(preg_match('/Kubuntu/i', $this->useragent)){
            $this->__link="http://www.kubuntu.org/";
            $this->__title="Kubuntu";
            if(preg_match('/Kubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $version.=" ".$regmatch[1];
            if($regmatch[1] < 10)
                $this->__code="kubuntu-1";
            else
                $this->__code="kubuntu-2";
            if(strlen($version) > 1)
                $this->__title.=$version;
        }elseif(preg_match('/LindowsOS/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/Lsongs";
            $this->__title="LindowsOS";
            $this->__code="lindowsos";
        }elseif(preg_match('/Linspire/i', $this->useragent)){
            $this->__link="http://www.linspire.com/";
            $this->__title="Linspire";
            $this->__code="lindowsos";
        }elseif(preg_match('/Linux\ Mint/i', $this->useragent)){
            $this->__link="http://www.linuxmint.com/";
            $this->__title="Linux Mint";
            if(preg_match('/Linux\ Mint\/([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="linuxmint";
        }elseif(preg_match('/Lubuntu/i', $this->useragent)){
            $this->__link="http://www.lubuntu.net/";
            $this->__title="Lubuntu";
            if(preg_match('/Lubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $version.=" ".$regmatch[1];
            if($regmatch[1] < 10)
                $this->__code="lubuntu-1";
            else
                $this->__code="lubuntu-2";
            if(strlen($version) > 1)
                $this->__title.=$version;
        }elseif(preg_match('/Mac/i', $this->useragent) || preg_match('/Darwin/i', $this->useragent)){
            $this->__link="http://www.apple.com/macosx/";
            if(preg_match('/Mac OS X/i', $this->useragent)){
                $this->__title=substr($this->useragent, strpos(strtolower($this->useragent), strtolower("Mac OS X")));
                $this->__title=substr($this->__title, 0, strpos($this->__title, ";"));
                $this->__title=str_replace("_", ".", $this->__title); 
                $this->__code="mac-3";
            }elseif(preg_match('/Mac OSX/i', $this->useragent)){
                $this->__title=substr($this->useragent, strpos(strtolower($this->useragent), strtolower("Mac OSX")));
                $this->__title=substr($this->__title, 0, strpos($this->__title, ";"));
                $this->__title=str_replace("_", ".", $this->__title); 
                $this->__code="mac-2";
            }elseif(preg_match('/Darwin/i', $this->useragent)){
                $this->__title="Mac OS Darwin";
                $this->__code="mac-1";
            }else {
                $this->__title="Macintosh";
                $this->__code="mac-1";
            }
        }elseif(preg_match('/Mandriva/i', $this->useragent)){
            $this->__link="http://www.mandriva.com/";
            $this->__title="Mandriva";
            if(preg_match('/mdv([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="mandriva";
        }elseif(preg_match('/moonOS/i', $this->useragent)){
            $this->__link="http://www.moonos.org/";
            $this->__title="moonOS";
            if(preg_match('/moonOS\/([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="moonos";
        }elseif(preg_match('/MorphOS/i', $this->useragent)){
            $this->__link="http://www.morphos-team.net/";
            $this->__title="MorphOS";
            $this->__code="morphos";
        }elseif(preg_match('/NetBSD/i', $this->useragent)){
            $this->__link="http://www.netbsd.org/";
            $this->__title="NetBSD";
            $this->__code="netbsd";
        }elseif(preg_match('/OpenBSD/i', $this->useragent)){
            $this->__link="http://www.openbsd.org/";
            $this->__title="OpenBSD";
            $this->__code="openbsd";
        }elseif(preg_match('/Oracle/i', $this->useragent)){
            $this->__link="http://www.oracle.com/us/technologies/linux/";
            $this->__title="Oracle";
            if(preg_match('/.el([._0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" Enterprise Linux ".str_replace("_", ".", $regmatch[1]);
            else
                $this->__title.=" Linux";
            $this->__code="oracle";
        }elseif(preg_match('/PCLinuxOS/i', $this->useragent)){
            $this->__link="http://www.pclinuxos.com/";
            $this->__title="PCLinuxOS";
            if(preg_match('/PCLinuxOS\/[.\-0-9a-zA-Z]+pclos([.\-0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".str_replace("_", ".", $regmatch[1]);
            $this->__code="pclinuxos";
        }elseif(preg_match('/Red\ Hat/i', $this->useragent) || preg_match('/RedHat/i', $this->useragent)){
            $this->__link="http://www.redhat.com/";
            $this->__title="Red Hat";
            if(preg_match('/.el([._0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" Enterprise Linux ".str_replace("_", ".", $regmatch[1]);
            $this->__code="mandriva";
        }elseif(preg_match('/Sabayon/i', $this->useragent)){
            $this->__link="http://www.sabayonlinux.org/";
            $this->__title="Sabayon Linux";
            $this->__code="sabayon";
        }elseif(preg_match('/Slackware/i', $this->useragent)){
            $this->__link="http://www.slackware.com/";
            $this->__title="Slackware";
            $this->__code="slackware";
        }elseif(preg_match('/Solaris/i', $this->useragent)){
            $this->__link="http://www.sun.com/software/solaris/";
            $this->__title="Solaris";
            $this->__code="solaris";
        }elseif(preg_match('/SunOS/i', $this->useragent)){
            $this->__link="http://www.sun.com/software/solaris/";
            $this->__title="Solaris";
            $this->__code="solaris";
        }elseif(preg_match('/Suse/i', $this->useragent)){
            $this->__link="http://www.opensuse.org/";
            $this->__title="openSUSE";
            $this->__code="suse";
        }elseif(preg_match('/Symb[ian]?[OS]?/i', $this->useragent)){
            $this->__link="http://www.symbianos.org/";
            $this->__title="SymbianOS";
            if(preg_match('/Symb[ian]?[OS]?\/([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $this->__title.=" ".$regmatch[1];
            $this->__code="symbianos";
        }elseif(preg_match('/Ubuntu/i', $this->useragent)){
            $this->__link="http://www.ubuntu.com/";
            $this->__title="Ubuntu";
            if(preg_match('/Ubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $version.=" ".$regmatch[1];
            if($regmatch[1] < 10)
                $this->__code="ubuntu-1";
            else
                $this->__code="ubuntu-2";
            if(strlen($version) > 1)
                $this->__title.=$version;
        }elseif(preg_match('/Unix/i', $this->useragent)){
            $this->__link="http://www.unix.org/";
            $this->__title="Unix";
            $this->__code="unix";
        }elseif(preg_match('/VectorLinux/i', $this->useragent)){
            $this->__link="http://www.vectorlinux.com/";
            $this->__title="VectorLinux";
            $this->__code="vectorlinux";
        }elseif(preg_match('/Venenux/i', $this->useragent)){
            $this->__link="http://www.venenux.org/";
            $this->__title="Venenux GNU Linux";
            $this->__code="venenux";
        }elseif(preg_match('/webOS/i', $this->useragent)){
            $this->__link="http://en.wikipedia.org/wiki/WebOS";
            $this->__title="Palm webOS";
            $this->__code="palm";
        }elseif(preg_match('/Windows/i', $this->useragent) || preg_match('/WinNT/i', $this->useragent) || preg_match('/Win32/i', $this->useragent)){
            $this->__link="http://www.microsoft.com/windows/";
            if(preg_match('/Windows NT 6.1; Win64; x64;/i', $this->useragent) || preg_match('/Windows NT 6.1; WOW64;/i', $this->useragent)){
                $this->__title="Windows 7 x64 Edition";
                $this->__code="win-4";
            }elseif(preg_match('/Windows NT 6.1/i', $this->useragent)){
                $this->__title="Windows 7";
                $this->__code="win-4";
            }elseif(preg_match('/Windows NT 6.0/i', $this->useragent)){
                $this->__title="Windows Vista";
                $this->__code="win-3";
            }elseif(preg_match('/Windows NT 5.2 x64/i', $this->useragent)){
                $this->__title="Windows XP x64 Edition";
                $this->__code="win-2";
            }elseif(preg_match('/Windows NT 5.2/i', $this->useragent)){
                $this->__title="Windows Server 2003";
                $this->__code="win-2";
            }elseif(preg_match('/Windows NT 5.1/i', $this->useragent) || preg_match('/Windows XP/i', $this->useragent)){
                $this->__title="Windows XP";
                $this->__code="win-2";
            }elseif(preg_match('/Windows NT 5.01/i', $this->useragent)){
                $this->__title="Windows 2000, Service Pack 1 (SP1)";
                $this->__code="win-1";
            }elseif(preg_match('/Windows NT 5.0/i', $this->useragent) || preg_match('/Windows 2000/i', $this->useragent)){
                $this->__title="Windows 2000";
                $this->__code="win-1";
            }elseif(preg_match('/Windows NT 4.0/i', $this->useragent) || preg_match('/WinNT4.0/i', $this->useragent)){
                $this->__title="Microsoft Windows NT 4.0";
                $this->__code="win-1";
            }elseif(preg_match('/Windows NT 3.51/i', $this->useragent) || preg_match('/WinNT3.51/i', $this->useragent)){
                $this->__title="Microsoft Windows NT 3.11";
                $this->__code="win-1";
            }elseif(preg_match('/Windows 3.11/i', $this->useragent) || preg_match('/Win3.11/i', $this->useragent) || preg_match('/Win16/i', $this->useragent)){
                $this->__title="Microsoft Windows 3.11";
                $this->__code="win-1";
            }elseif(preg_match('/Windows 3.1/i', $this->useragent)){
                $this->__title="Microsoft Windows 3.1";
                $this->__code="win-1";
            }elseif(preg_match('/Windows 98; Win 9x 4.90/i', $this->useragent) || preg_match('/Win 9x 4.90/i', $this->useragent) || preg_match('/Windows ME/i', $this->useragent)){
                $this->__title="Windows Millennium Edition (Windows Me)";
                $this->__code="win-1";
            }elseif(preg_match('/Win98/i', $this->useragent)){
                $this->__title="Windows 98 SE";
                $this->__code="win-1";
            }elseif(preg_match('/Windows 98/i', $this->useragent) || preg_match('/Windows\ 4.10/i', $this->useragent)){
                $this->__title="Windows 98";
                $this->__code="win-1";
            }elseif(preg_match('/Windows 95/i', $this->useragent) || preg_match('/Win95/i', $this->useragent)){
                $this->__title="Windows 95";
                $this->__code="win-1";
            }elseif(preg_match('/Windows CE/i', $this->useragent)){
                $this->__title="Windows CE";
                $this->__code="win-2";
            }elseif(preg_match('/WM5/i', $this->useragent)){
                $this->__title="Windows Mobile 5";
                $this->__code="win-phone";
            }elseif(preg_match('/WindowsMobile/i', $this->useragent)){
                $this->__title="Windows Mobile";
                $this->__code="win-phone";
            }else{
                $this->__title="Windows";
                $this->__code="win-2";
            }
        }elseif(preg_match('/Xandros/i', $this->useragent)){
            $this->__link="http://www.xandros.com/";
            $this->__title="Xandros";
            $this->__code="xandros";
        }elseif(preg_match('/Xubuntu/i', $this->useragent)){
            $this->__link="http://www.xubuntu.org/";
            $this->__title="Xubuntu";
            if(preg_match('/Xubuntu[\/|\ ]([.0-9a-zA-Z]+)/i', $this->useragent, $regmatch))
                $version.=" ".$regmatch[1];
            if($regmatch[1] < 10)
                $this->__code="xubuntu-1";
            else
                $this->__code="xubuntu-2";
            if(strlen($version) > 1)
                $this->__title.=$version;
        }elseif(preg_match('/Zenwalk/i', $this->useragent)){
            $this->__link="http://www.zenwalk.org/";
            $this->__title="Zenwalk GNU Linux";
            $this->__code="zenwalk";

        //Pulled out of order to help ensure better detection for above platforms
        }elseif(preg_match('/Linux/i', $this->useragent)){
            $this->__link="http://www.linux.org/";
            $this->__title="GNU/Linux";
            $this->__code="linux";
            if(preg_match('/x86_64/i', $this->useragent))
                $this->__title.=" x64";
        }elseif(preg_match('/J2ME\/MIDP/i', $this->useragent)){
            $this->__link="http://java.sun.com/javame/";
            $this->__title="J2ME/MIDP Device";
            $this->__code="java";
        }
    }

/**
 * Detect Platform (check for OS, then Device).
 *
 * @return string Type of Platform 
 * @access private
 */
    private function detect_platform(){
        $this->__title="Unknown";
        $this->__link="#";
        $this->__code=null;
        
        $this->detect_os();
        if($this->__code===null) $this->detect_device();
        else return 'os';
        if($this->__code!==null) return 'device';
        else return null;
    }

 /**
 * Returns Browser Icon.
 *
 * @param string optional User Agent.
 * @access public
 */
    public function platform($useragent = null) {
        if($useragent!==null) $this->useragent = $useragent;
        $type = $this->detect_platform();
        // Add Unknown Icon
        if($type===null) {
            $type = 'os';
            $this->__code = 'unknown';
        }
        return $this->Html->image('/user_agent/img/16/'.$type.'/'.$this->__code.'.png', array('alt' => $this->__title));
    }


}
