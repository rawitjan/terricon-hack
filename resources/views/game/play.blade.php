@extends('layouts.app')

@section('content')
<div class="card card-body">
    <div id="question-container">
        <!-- Вопросы будут динамически вставляться сюда -->
    </div>
    <button id="next-button" class="btn btn-primary d-none">@lang('next')</button>
    <form id="game-form" action="{{ route('game.submit', $game) }}" method="POST" class="d-none">
        @csrf
        <input type="hidden" name="answers" id="answers-input">
        <button type="submit" class="btn btn-primary w-100">@lang('finish')</button>
    </form>
</div>
<script>
const questions = @json(json_decode($game->data, true));
    let currentQuestionIndex = 0;
    const answers = [];
    const questionContainer = document.getElementById('question-container');
    const nextButton = document.getElementById('next-button');
    const form = document.getElementById('game-form');
    const answersInput = document.getElementById('answers-input');

    function showQuestion(index) {
        const question = questions[index];
        questionContainer.innerHTML = '';

        let questionHtml = '';
        if ("{{ $game->game_type }}" === 'find_by_description') {
            questionHtml += `<p><strong>${index + 1}:</strong> ${question.question}</p>`;
        } else if ("{{ $game->game_type }}" === 'find_by_thumbnail') {
            questionHtml += `<div class="d-flex w-100"><img src="${question.question}" class="img-thumbnail w-100 mx-auto" style="max-width: 250px;"></div>`;
        }

        questionHtml += `<div class="row">`;
        question.options.forEach(option => {
            questionHtml += `
                <div class="col-12 col-md-6 mb-2">
                    <input type="radio" class="btn-check" name="answer" id="option${option.id}" value="${option.id}" autocomplete="off">
                    <label class="btn btn-outline-primary w-100" for="option${option.id}">${option.title}</label>
                </div>
            `;
        });
        questionHtml += `</div>`;

        questionContainer.innerHTML = questionHtml;
        nextButton.classList.add('d-none');
    }

    function handleAnswer() {
        const selectedOption = document.querySelector('input[name="answer"]:checked');
        if (!selectedOption) return;

        const selectedValue = parseInt(selectedOption.value);
        answers[currentQuestionIndex] = selectedValue;

        const correctAnswer = questions[currentQuestionIndex].answer;

        const allOptions = document.querySelectorAll('input[name="answer"]');
        allOptions.forEach(option => {
            option.nextElementSibling.classList.add('pe-none');
        });

        if (selectedValue === correctAnswer) {
            selectedOption.nextElementSibling.classList.add('bg-primary');
            selectedOption.nextElementSibling.classList.add('text-dark');
        } else {
            selectedOption.nextElementSibling.classList.add('bg-danger');
            selectedOption.nextElementSibling.classList.add('text-white');
            const correctOption = document.getElementById(`option${correctAnswer}`);
            if (correctOption) {
                correctOption.nextElementSibling.classList.add('bg-info')
                correctOption.nextElementSibling.classList.add('text-dark');;
            }
        }

        nextButton.classList.remove('d-none');
    }

    nextButton.addEventListener('click', () => {
        currentQuestionIndex++;

        if (currentQuestionIndex < questions.length) {
            showQuestion(currentQuestionIndex);
        } else {
            answersInput.value = JSON.stringify(answers);
            form.classList.remove('d-none');
            nextButton.classList.add('d-none');
        }
    });

    // Обработка выбора ответа
    questionContainer.addEventListener('change', function(event) {
        if (event.target.name === 'answer') {
            handleAnswer();
        }
    });

    // Отображаем первый вопрос
    showQuestion(currentQuestionIndex);
</script>
@endsection
