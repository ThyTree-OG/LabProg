@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-orange-custom">Activities</h1>
    <p class="mb-4">Here are some fun activities to do after reading a book:</p>

    <!-- Activity 1 -->
    <div class="card shadow p-4 mb-4">
        <h2 class="text-orange-custom mb-3">Book-Themed Drawing</h2>
        <p class="mb-3">Encourage your child to draw their favorite scene or character from the book they just read. This helps them to think creatively and remember the story better.</p>
        <p class="mb-2">Materials needed:</p>
        <ul class="list-unstyled">
            <li class="mb-1"><i class="bi bi-pencil text-warning"></i> Pencils or crayons</li>
            <li class="mb-1"><i class="bi bi-easel text-warning"></i> Paper or drawing pad</li>
            <li class="mb-1"><i class="bi bi-eraser text-warning"></i> Eraser</li>
        </ul>
        <p class="mt-4">Optional: Display the drawings in a "book gallery" at home or share them with friends and family!</p>
    </div>

    <!-- Activity 2 -->
    <div class="card shadow p-4 mb-4">
        <h2 class="text-orange-custom mb-3">Story Retelling</h2>
        <p class="mb-3">Ask your child to retell the story in their own words. This helps with comprehension and language skills.</p>
        <p class="mb-2">Materials needed:</p>
        <ul class="list-unstyled">
            <li class="mb-1"><i class="bi bi-people text-warning"></i> Family or friends to listen</li>
            <li class="mb-1"><i class="bi bi-chat-dots text-warning"></i> An enthusiastic narrator</li>
        </ul>
        <p class="mt-4">Optional: Record the retelling to share with others or keep as a memory!</p>
    </div>

    <!-- Activity 3 -->
    <div class="card shadow p-4 mb-4">
        <h2 class="text-orange-custom mb-3">Book Review</h2>
        <p class="mb-3">Encourage your child to write a short review of the book, including what they liked or didn't like about it.</p>
        <p class="mb-2">Materials needed:</p>
        <ul class="list-unstyled">
            <li class="mb-1"><i class="bi bi-pencil text-warning"></i> Pen or pencil</li>
            <li class="mb-1"><i class="bi bi-book text-warning"></i> Notebook or paper</li>
        </ul>
        <p class="mt-4">Optional: Create a book review journal to keep track of all the books read and reviewed!</p>
    </div>

    <!-- Activity 4 -->
    <div class="card shadow p-4 mb-4">
        <h2 class="text-orange-custom mb-3">Character Acting</h2>
        <p class="mb-3">Let your child act out scenes or play the roles of different characters from the book. This helps with imagination and expressive skills.</p>
        <p class="mb-2">Materials needed:</p>
        <ul class="list-unstyled">
            <li class="mb-1"><i class="bi bi-mask text-warning"></i> Costumes or props (optional)</li>
            <li class="mb-1"><i class="bi bi-person-square text-warning"></i> Space to perform</li>
        </ul>
        <p class="mt-4">Optional: Make a short play and invite family members to watch the performance!</p>
    </div>
</div>
@endsection
