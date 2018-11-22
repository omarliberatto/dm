// Funcion aplicada a todos los checkbox
$(".boolean-check").ready(function() {
    $("input[type='checkbox']").on('change', function(){
        $(".hidden-check").val(this.checked ? 1 : 0);
    });
});

//Funcion que pregunta si desea eliminar un dato, implementado con BootBoxJS
function eliminar(id, nombre_elemnto) {
    bootbox.confirm("Desea eliminar "+nombre_elemnto+"?", function(result){
        if(result){
            $( "#delete_"+id ).submit();
        }else{
            void(0);
        }
    });
}

//Funcion que pregunta si desea cambiar el estado (visible) de un telefono, implementado con BootBoxJS
function telefonosVisible(id, bool) {

    if(!bool){
        text='mostrar';
    }else{
        text='ocultar';
    }

    bootbox.confirm("Desea cambiar el estado actual a <strong>" + text + "</strong> en <strong>" + id + "</strong> ?", function(result){
        if(result){
            $( "#visible_"+id ).submit();
        }else{
            void(0);
        }
    });

}

// Funcion aplicada a todos los index de las vistas con Datatables para agregar botón ver, editar y eliminar
function actionButtons(data, url, csrf_field, buttons) {

    valid = true;
    if(data == null || url == null || csrf_field == null){
        valid=false;
    }

    if (valid){

        html = '<form method="POST" action="'+ url + '/' + data.id + '" accept-charset="UTF-8" id="delete_'+ data.id +'">' +
            '<input name="_method" type="hidden" value="DELETE">'+
            csrf_field;

        buttons.forEach(function( button ) {
            switch (button) {
                case "show":
                    html += '<a href="'+ url + '/' + data.id + '/show" class="btn btn-default glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Ver datos"></a>';
                    break;
                case "edit":
                    html += '<a href="'+ url + '/' + data.id + '/edit" style="margin-left:3%;" class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></a>';
                    break;
                case "delete":
                    html += '<button class="btn btn-danger" type="button" style="margin-top:1px; margin-left:3%;" onclick="eliminar(' + data.id + ', \'' + data.name + '\');" data-toggle="tooltip" data-placement="top" title="Eliminar">' +
                        '<span class="glyphicon glyphicon-trash"></span>' +
                        '</button>';
                    break;
            }
        });

        html += '</form>';

        return html;

    }else{
        return '{Error}';
    }

}

// Funcion aplicada a todos los index de las vistas con Datatables para agregar botón ver, editar y eliminar
function telefonosButtons(data, url, csrf_field) {

    valid = true;
    if(data == null || url == null || csrf_field == null){
        valid=false;
    }

    if (valid){

        if(data.visible){
            classIcon = 'eye-open';
            classBtn = 'success';
            visibleSave = 0;
            tooltip = 'Ocultar';
        }else {
            classIcon = 'eye-close';
            classBtn = 'default';
            visibleSave = 1;
            tooltip = 'Mostrar';
        }

        html = '<form method="POST" action="'+ url + '/' + data.id + '" id="visible_'+ data.id +'" accept-charset="UTF-8">' +
            '<input name="_method" type="hidden" value="PUT">'+
            '<input name="visible" type="hidden" value="' + visibleSave +'" id="visible">'+
            csrf_field;

        html += '<button type="button" class="btn btn-'+ classBtn +' " style="margin-top:1px;" onclick="telefonosVisible(' + data.id + ', ' + data.visible + ');" data-toggle="tooltip" data-placement="top" title="' + tooltip + '">' +
            '<span class="glyphicon glyphicon-'+ classIcon +'"></span>' +
            '</button>';

        html += '<a href="'+ url + '/' + data.id + '/edit" style="margin-left:3%;" class="btn btn-primary glyphicon glyphicon-pencil"  data-toggle="tooltip" data-placement="top" title="Editar"></a>';

        html += '</form>';

        return html;

    }else{
        return '{Error}';
    }

}