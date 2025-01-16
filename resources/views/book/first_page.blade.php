@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="container py-5">
    <h1 class="custom-font text-center">{{ $book->title }}</h1>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 text-center">
            <div id="page-container" class="d-flex flex-column align-items-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <button id="previous" class="btn btn-primary me-3" disabled>Previous</button>
                    <img id="page" src="{{ $firstPage }}" alt="First Page" style="width: 80%; height: 80%; border: 1px solid #ccc;">
                    <button id="next" class="btn btn-primary ms-3">Next</button>
                </div>
                <p id="page-number" class="mt-3" style="color: #6c757d; font-size: 16px;">Page 1</p>
                <div class="progress mt-2" style="width: 70%; background-color: #f8f9fa; height: 30px;">
                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%; background-color: #d95c0e; height: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pages = Object.values(@json($pages)); // Lista de URLs das páginas
        const bookId = {{ $book->id }}; // ID do livro
        let currentIndex = {{ $startPage - 1 }}; // Inicia na página calculada (baseada no progresso salvo)

        const pageImg = document.getElementById('page');
        const pageNumber = document.getElementById('page-number');
        const prevButton = document.getElementById('previous');
        const nextButton = document.getElementById('next');
        const progressBar = document.getElementById('progress-bar');

        function updatePage() {
            // Atualizar imagem e número da página
            pageImg.src = pages[currentIndex];
            pageNumber.textContent = `Page ${currentIndex + 1}`;

            // Atualizar barra de progresso
            const progress = Math.round((currentIndex / (pages.length - 1)) * 100);
            progressBar.style.width = `${progress}%`;
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.textContent = `${progress}%`;

            // Ativar/desativar botões com base no índice atual
            prevButton.disabled = currentIndex === 0;
            nextButton.disabled = currentIndex === pages.length - 1;

            // Salvar progresso automaticamente
            autoSaveProgress(bookId, progress);
        }

        function autoSaveProgress(bookId, progress) {
            console.log(`Saving progress for bookId: ${bookId}, progress: ${progress}`);
            if (progress >= 0 && progress <= 100) { // Validar progresso
                fetch(`/books/${bookId}/progress`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token CSRF necessário para requisições POST
                    },
                    body: JSON.stringify({ progress: progress }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data.message); // Mensagem de sucesso
                })
                .catch(error => {
                    console.error('Error while saving progress:', error); // Exibir erro no console
                });
            } else {
                console.warn(`Invalid progress value: ${progress}. Must be between 0 and 100.`);
            }
        }

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updatePage();
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < pages.length - 1) {
                currentIndex++;
                updatePage();
            }
        });

        // Inicializar a página calculada
        updatePage();
    });
</script>
@endsection
