function dosearch() {
    var sf=document.searchform;
    for (i=sf.sengines.length-1; i > -1; i--) {
        if (sf.sengines[i].checked) {
            var submitto = sf.sengines[i].value + escape(sf.searchterms.value);
        }
    }
    window.location.href = submitto;
    return false;
}