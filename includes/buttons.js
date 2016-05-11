( function() {
    tinymce.PluginManager.add( 'fb_test', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'type_button', {

            icon: 'my-mce-btn',
            onclick: function() {
                // Open window
                editor.windowManager.open( {
                    title: 'Add button',
                    body: [{
                        type: 'textbox',
                        name: 'text',
                        label: 'Text'
                    },{
                        type: 'textbox',
                        name: 'url',
                        label: 'URL'
                    }],
                    onsubmit: function( e ) {
                        editor.insertContent(
                            '[button href="' + e.data.url + '"]' + e.data.text + '[/button]'
                        );
                    }

                } );
            }

        } );

        // Add a button that opens a window
        editor.addButton( 'type_alert', {

            icon: 'my-mce-alert',
            onclick: function() {
                // Open window
                editor.windowManager.open( {
                    title: 'Add alert',
                    body: [{
                        type: 'listbox',
                        name: 'type',
                        label: 'Type',
                        values: [
                            {text: 'Success', value: 'success'},
                            {text: 'Warning', value: 'warn'}
                        ]
                    },{
                        type: 'textbox',
                        name: 'text',
                        label: 'Text'
                    }],
                    onsubmit: function( e ) {
                        editor.insertContent(
                            '[alert type="' + e.data.type + '"]' + e.data.text + '[/alert]'
                        );
                    }

                } );
            }

        } );

        // Add a button that opens a window
        editor.addButton( 'type_pullquote', {

            icon: 'my-mce-pullquote',
            onclick: function() {
                // Open window
                editor.windowManager.open( {
                    title: 'Add pullquote',
                    body: [{
                        type: 'textbox',
                        name: 'text',
                        label: 'Text'
                    }],
                    onsubmit: function( e ) {
                        editor.insertContent(
                            '[pullquote]' + e.data.text + '[/pullquote]'
                        );
                    }

                } );
            }

        } );

    } );

} )();
