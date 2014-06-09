$(document).ready(function() {
    //Turn all div with the report demo folder tree class into jstrees
    $('#jstree').jstree({
        'core': {
            'data': {
                'url': function(node) {
                    return $('#jstree').data('url');
                },
                'data': function(node) {
                    return { 'id': node.id };
                },
                'dataType': 'json',
                'type': 'GET'
            }
        }
    })
    .on('changed.jstree', function(e, data){
        if (undefined !== data.node.a_attr.href && '#' !== data.node.a_attr.href) {
            window.location.replace(data.node.a_attr.href);
        } else {
            if (data.node.state.opened) {
                $('#jstree').jstree('close_node', data.node);
            } else {
                $('#jstree').jstree('open_node', data.node);
            }
        }
    });
});