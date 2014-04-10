var __all_scripts = [
    'js/generated/custom.modernizr.js',
    'vendor/jquery/dist/jquery.js',
        'vendor/jquery-ui/ui/jquery-ui.js',
        'vendor/underscore/underscore.js',
        'vendor/backbone/backbone-min.js',
        'vendor/vie/dist/vie.js',
        'vendor/rangy/rangy-core.js',
        'vendor/create/dist/create.js',

        /** Foundation **/
        'js/generated/foundation.js',
        //'js/generated/foundation.alerts.js',
        'js/generated/foundation.clearing.js',
        //'js/generated/foundation.cookie.js',
        'js/generated/foundation.dropdown.js',
        //'js/generated/foundation.forms.js',
        'js/generated/foundation.joyride.js',
        'js/generated/foundation.magellan.js',
        'js/generated/foundation.orbit.js',
        //'js/generated/foundation.placeholder.js',
        'js/generated/foundation.reveal.js',
        //'js/generated/foundation.section.js',
        //'js/generated/foundation.tooltips.js',
        'js/generated/foundation.topbar.js',
        'js/generated/foundation.interchange.js',
        'vendor/requirejs/require.js',


        'js/cms.js'
];

if(typeof module !== 'undefined' && module.exports){
    //From node js
    global.__all_scripts = [];

    for(var k=0; k < __all_scripts.length; k++){
        global.__all_scripts.push('./web/'+__all_scripts[k]);
    }

}else{
    //From a browser

    var load_script = function(k){
        if(k>=__all_scripts.length){
            return;
        }

        var js = document.createElement("script");
        js.type = "text/javascript";
        js.src = '/'+__all_scripts[k];
        js.onload = function(){
            load_script(k+1);
        };
        document.body.appendChild(js);
    };
    load_script(0);
}
