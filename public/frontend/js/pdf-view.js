    var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
        var pdf1 = base_url + '/frontend/resume_pdf/' + nameData.resume_fullname + '_' + user + '_' + r_id + '.pdf';
        var pdf2 = base_url + '/frontend/resume_pdf/' + nameData.resume_fullname + '_' + user + '_' + r_id + '.pdf';
        
        loadPDF();
function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');
                var viewport = page.getViewport(myState.zoom);
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }
        
document.getElementById('go_previous')
    .addEventListener('click', (e) => {
    /*if(myState.pdf == null|| myState.currentPage == 1) 
    return;*/
    if(myState.pdf == null|| myState.currentPage === 1) 
    return;
    // myState.currentPage -= 1;
    myState.currentPage--;
    document.getElementById("current_page").value = myState.currentPage;
    document.getElementById("cur_page").innerHTML = myState.currentPage;
    render();
});

document.getElementById('go_next')
    .addEventListener('click', (e) => {
    /*if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) 
    return;*/
    if(myState.pdf == null || myState.currentPage >= myState.pdf._pdfInfo.numPages) 
    return;
    // myState.currentPage += 1;
    myState.currentPage++;
    document.getElementById("current_page").value = myState.currentPage;
    document.getElementById("cur_page").innerHTML = myState.currentPage;
    render();
});

document.getElementById('load_2')
    .addEventListener('click', (e) => {
    
pdfjsLib.getDocument(pdf2).then((pdf) => {
            myState.pdf = pdf;
            render();
        });
//    render();
});

function loadPDF(){
    pdfjsLib.getDocument(pdf1).then((pdf) => {
            myState.pdf = pdf;
            var totalpages = myState.pdf._pdfInfo.numPages;
            document.getElementById("total_page").innerHTML = totalpages;
            render();
        });
}