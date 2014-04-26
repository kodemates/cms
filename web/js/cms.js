(function($){
    function Manager(){
        var obj = {
            urls: {}
        };

        obj.editContent = function(){
            var self = this;
            $('body').midgardCreate({
                url: function() {
                    return self.urls.content_create;
                },
                editorWidgets: {
                    'default': 'aloha'
                },
                editorOptions: {
                    aloha: {
                        widget: 'alohaWidget'
                    }
                },
                collectionWidgets: {
                    'default': null,
                    'feature': 'midgardCollectionAdd'
                }
            });
        }

        return obj;
    };

    window.CMSManager = Manager();
    if('function' == typeof __loadConfigs) __loadConfigs();
    if('function' == typeof __init) __init();

})(jQuery);