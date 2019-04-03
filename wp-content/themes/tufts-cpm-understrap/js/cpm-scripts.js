(function($) {
  $(document).on('facetwp-loaded', function() {
    console.log(FWP.facets);
    active = false;
    $.each(FWP.facets, function(key, val) {
      if (val.length > 0) {
        console.log(key);
        $('.facetwp-facet-'+key).addClass('active');
        active = true;
      }
    });
    // activate tableexport
    $('table').tableExport({
      formats: ["csv", "txt"],
    });
});

  function checkForActiveFacets(facets) {
    //console.log(facets);
    var active = false;
    $.each(facets, function(key, val) {
      if (val.length > 0) {
        console.log(key);
        active = true;
      }
    });
    return active;
  }
})(jQuery);
