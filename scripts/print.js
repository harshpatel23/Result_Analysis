function printpdf(){
	var pdf = new jsPDF('p', 'pt', 'letter');
    source = $('#printpdf')[0];

    specialElementHandlers = {
        '#bypassme': function (element, renderer) {
            return true
        }
    };
    margins = {
        top: 30,
        bottom: 60,
        left: 40,
        width: 522
    };
    pdf.fromHTML(
    source, 
    margins.left, 
    margins.top, { 
        'width': margins.width, 
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        pdf.save('Analysis.pdf');
    }, margins);
}