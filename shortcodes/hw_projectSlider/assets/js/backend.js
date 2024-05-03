jQuery(function ($) {
    new SlimSelect({
        select: '#hw-generalSider'
    })


    $("#hw-generalSider-sortable-notSelected,#hw-generalSider-sortable-selected").sortable({
        connectWith: ".connectedSortable",
    }).disableSelection();

    $("#hw-generalSider-sortable-selected").on("sortupdate", function (event, ui) {
        // console.log($(event));
        console.log($('#hw-generalSider-sortable-selected').sortable("toArray"));
        let selectedProjects = $('#hw-generalSider-sortable-selected').sortable("toArray").filter(item => item);
        $('#hw_projectSlider-multiselect-field').val(selectedProjects)
    });
})