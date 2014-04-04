(function($){
    function Manager(){
        var self = this;

        function editContent(){
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
                },
                stanbolUrl: 'http://dev.iks-project.eu:8081'
            });
        }

        return {
            urls: {},
            editContent: editContent
        };
    };

    window.CMSManager = Manager();
})(jQuery);
