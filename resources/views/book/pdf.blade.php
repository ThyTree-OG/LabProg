@extends('layouts.app')

@section('title', 'Read Book - ' . $book->title)

@section('content')
<div class="container my-5">
    <h1 class="text-center">{{ $book->title }}</h1>
    <p class="text-center text-muted">by {{ $book->author }}</p>

    <!-- PDF Viewer -->
    <div id="pdf-container" class="mt-4">
        <canvas id="pdf-canvas"></canvas>
    </div>

    <!-- Navigation Controls -->
    <div class="text-center mt-3">
        <button id="prev-page" class="btn btn-warning">Previous</button>
        <span>Page: <span id="page-num">1</span> / <span id="page-count">--</span></span>
        <button id="next-page" class="btn btn-warning">Next</button>
    </div>
</div>
@endsection

@push('styles')
<style>
    #pdf-container {
        text-align: center;
        margin: 0 auto;
    }

    canvas {
        border: 1px solid #ddd;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<!-- Include PDF.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
<script>
    const url = "{{ $pdfPath }}";
    let pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 1.5,
        canvas = document.getElementById('pdf-canvas'),
        ctx = canvas.getContext('2d');

    const renderPage = (num) => {
        pageRendering = true;

        // Get page
        pdfDoc.getPage(num).then((page) => {
            const viewport = page.getViewport({ scale: scale });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            const renderTask = page.render(renderContext);

            renderTask.promise.then(() => {
                pageRendering = false;

                if (pageNumPending !== null) {
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });

        // Update page counters
        document.getElementById('page-num').textContent = num;
    };

    const queueRenderPage = (num) => {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    };

    const onPrevPage = () => {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    };

    const onNextPage = () => {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    };

    document.getElementById('prev-page').addEventListener('click', onPrevPage);
    document.getElementById('next-page').addEventListener('click', onNextPage);

    // Load the PDF
    pdfjsLib.getDocument(url).promise.then((pdfDoc_) => {
        pdfDoc = pdfDoc_;
        document.getElementById('page-count').textContent = pdfDoc.numPages;

        // Render the first page
        renderPage(pageNum);
    }).catch((error) => {
        console.error('Error loading PDF: ', error);
        alert('Failed to load the PDF.');
    });
</script>
@endpush
