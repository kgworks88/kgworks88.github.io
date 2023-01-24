//import { animals } from './animals';
//import React from 'react';
//import ReactDOM from 'react-dom';

const animals = {
  dolphin: {
    image: 'images/dolphin.jpg',
    facts: ['Dolphins have been shown to give distinct names to each other!', 'Dolphins are known to display their own culture!', 'Dolphins have two stomachs!']
  },
  lobster: {
    image: 'images/lobster.jpg',
    facts: ['Lobsters taste with their legs!', 'Lobsters chew with their stomachs!', 'Lobsters can live as long as 100 years.']
  },
  starfish: {
    image: 'images/starfish.jpg',
    facts: ['Starfish can have up to 40 arms!', 'Starfish have no brain and no blood!', 'Starfish can regenerate their own arms!']
  }
};

const title = '';
let images = [];

for(const animal in animals){
  images.push(
    <img      
      key={animal}  
      className='animal'   
      alt={animal}
      src={animals[animal].image}
      aria-label={animal}
      role='button'
      onClick={displayFact}
    />
  )
}

const background = (
<img 
  className = 'background'
  alt = 'ocean'
  src='images/ocean.jpg'
/>
);
const showBackground = true;
const animalFacts = (
  <div>
    <h1>
      {title || 'Click an animal for a fun fact'/*title === '' ? 'Click an animal for a fun fact' : title*/}
    </h1>
    {showBackground && background}
    <div className='animals'>
      {images}
    </div>
    <p id='fact'></p>
  </div>
);

function displayFact(e){
  const selectedAnimal = e.target.alt;
  const optionIndex = Math.floor(Math.random()*animals[selectedAnimal].facts.length);
  //window.alert(optionIndex);
  document.getElementById('fact').innerHTML = animals[selectedAnimal].facts[optionIndex];
}

ReactDOM.render(animalFacts,
  document.getElementById('root'));
