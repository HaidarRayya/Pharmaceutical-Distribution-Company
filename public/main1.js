const card = document.getElementById('card');
const flipButton = document.getElementById('flipButton');
const flipButtonBack = document.getElementById('flipButtonBack');

flipButton.addEventListener('click', () => {
    card.querySelector('.card-inner').style.transform = 'rotateY(180deg)';
});

flipButtonBack.addEventListener('click', () => {
    card.querySelector('.card-inner').style.transform = 'rotateY(0deg)';
});