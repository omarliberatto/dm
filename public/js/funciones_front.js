// Funcion aplicada a todos los checkbox
function frontLoaded() {

    elements=$("#DataTables_Table_0_wrapper .col-sm-6");
    elements.first().remove();
    elements.last().removeClass( "col-sm-6" ).addClass( "col-sm-12 buscador" );

};

