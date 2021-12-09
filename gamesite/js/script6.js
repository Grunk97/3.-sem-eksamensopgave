// Laver varibaler som vi bruger længere nede.
let canvas = document.querySelector("canvas");
let ctx = canvas.getContext("2d")
let tileSize = 50;
let playerImage = new Image();
playerImage.src ='img/player1.png';
let wallImage = new Image();
wallImage.src ='img/wall.png';
let lavaImage = new Image();
lavaImage.src ='img/monster1.png';
let finishImage = new Image();
finishImage.src ='img/door1.png';
let floorImage = new Image();
floorImage.src ='img/floor.jpg';
let diaImage = new Image();
diaImage.src ='img/diamond1.png';
let hulImage = new Image();
hulImage.src ='img/void.png';
let health = document.getElementById("health");
let point = document.getElementById("point");
let score = 0;

// Laver en function der afspiller gå-lyde.
function walk(){

    let gameSound = new Audio('sound/walk.mp3');
    gameSound.play();
    
    }

// Laver en function der afspiller død-lyd.
function dead(){

    let deadSound = new Audio('sound/dead.mp3');
    deadSound.play();
        
    }

// Laver en function der afspiller win-lyd.
function win(){

    let winSound = new Audio('sound/win.mp3');
    winSound.play();
        
    }

// Laver en function der afspiller collect-lyde.
function collect(){

    let collectSound = new Audio('sound/collect.mp3');
    collectSound.play();
        
    }   

// Vi tager fat i DOMEN og når denne loades op (når man går ind på siden) afspiller den musik.
window.addEventListener("DOMContentLoaded", event => {
    const audio = document.querySelector("audio");
    audio.volume = 0.1;
    audio.play();
    });


// Laver en timer til visuel brug (ønskes dog at bruge den til score).
var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var totalSeconds = 0;
setInterval(setTime, 1000);

function setTime() {
    ++totalSeconds;
    secondsLabel.innerHTML = pad(totalSeconds % 60);
    minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}

function pad(val) {
    var valString = val + "";
    if (valString.length < 2) {
    return "0" + valString;
    } else {
    return valString;
    }
} 



/*ctx.fillRect(x,y,50,50); */

//Vi laver banen ved hjælp af array
let arr = [
    [1,0,0,3,3,3,0,3,3,3,0,0,0,0,2,0,0,3,3,3],
    [3,0,5,3,6,3,3,3,0,3,0,0,3,3,3,0,5,3,0,3],
    [3,3,0,3,3,0,2,0,0,3,0,2,3,0,3,3,0,3,0,3],
    [2,3,3,0,3,0,3,3,3,3,0,3,3,0,0,3,3,3,2,3],
    [0,0,3,3,3,0,3,0,0,6,0,3,0,0,0,0,0,0,0,3],
    [0,0,0,6,0,0,3,0,0,3,3,3,0,0,0,0,3,3,3,3],
    [5,3,0,0,0,0,3,2,3,3,0,0,5,3,3,6,3,0,3,2],
    [2,3,3,3,0,0,3,3,3,0,0,0,0,0,3,3,3,0,3,3],
    [3,3,6,3,3,0,6,0,0,0,0,0,0,3,3,3,0,0,0,5],
    [3,0,0,0,3,3,0,0,0,0,0,0,3,3,0,0,0,5,0,0],
    [3,0,0,0,0,3,0,5,3,0,0,0,3,0,0,0,3,3,0,0],
    [3,3,3,0,0,3,0,2,3,3,3,3,3,0,0,0,3,6,0,0],
    [0,6,3,0,0,3,0,0,3,6,0,0,0,0,3,3,3,3,0,0],
    [0,3,3,0,0,3,0,0,3,0,0,0,3,3,3,0,0,3,0,0],
    [0,3,2,3,3,3,3,0,3,3,3,3,3,0,0,0,2,3,3,0],
    [0,3,0,3,0,6,3,0,0,0,0,0,0,0,0,0,0,0,3,0],
    [0,3,0,3,0,5,3,0,0,3,3,3,3,6,5,2,3,3,3,0],
    [0,3,0,3,0,0,0,2,0,3,2,0,3,3,3,0,3,0,0,0],
    [0,3,0,3,3,3,3,3,3,3,0,0,0,3,0,0,3,3,5,6],
    [0,4,0,0,6,0,0,0,0,0,0,0,0,3,3,3,3,0,0,0]
]

//Laver varibaler til vores array
let wall = 0
let player = 1
let monster = 2
let free = 3
let finish = 4
let diamond = 5
let hul = 6
let playerPosition = {x:0, y:0}

console.log(arr);

//Laver vores bane
function drawMaze(){

//Laver et for loop der bliver ved indtil der ikke er flere tal i arrayet
for(let x = 0; x < arr.length; x++){

    for(let y = 0; y < arr[x].length; y++){

        //Fortæller hvilket billede der skal være udfra hvilken variable vi har taget fat i.
        if(arr[x][y] == wall){
            ctx.drawImage(wallImage,x*tileSize,y*tileSize,tileSize,tileSize);
        } 
        if(arr[x][y] == player){
            playerPosition.x = x;
            playerPosition.y = y;
            ctx.drawImage(playerImage,x*tileSize,y*tileSize,tileSize,tileSize);
        }
        if(arr[x][y] == monster){
            ctx.drawImage(lavaImage,x*tileSize,y*tileSize,tileSize,tileSize);
        }
        if(arr[x][y] == free){
            ctx.drawImage(floorImage,x*tileSize,y*tileSize,tileSize,tileSize);
        }
        if(arr[x][y] == finish){
            ctx.drawImage(finishImage,x*tileSize,y*tileSize,tileSize,tileSize);
        }
        if(arr[x][y] == diamond){
            ctx.drawImage(diaImage,x*tileSize,y*tileSize,tileSize,tileSize);
        }
        if(arr[x][y] == hul){
            ctx.drawImage(hulImage,x*tileSize,y*tileSize,tileSize,tileSize);
        }
    }

    }
}

// Hvad skal der ske når vi trykker på en af piletasterne (keycode).
// venstre: 37 
// op: 38
// højre: 39
// ned: 40

document.addEventListener("keyup", function(event){
    if(event.keyCode == 37){
        if(arr[playerPosition.x -1][playerPosition.y] == free){
            arr[playerPosition.x -1][playerPosition.y] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            walk();
        }
        else if(arr[playerPosition.x -1][playerPosition.y] == monster){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 10;
            score -= 10;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x -1][playerPosition.y] == diamond){
            arr[playerPosition.x -1][playerPosition.y] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            collect();
            point.value += 10;
            score += 31;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x -1][playerPosition.y] == hul){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 30;
        }
        
        if(health.value == 0){
            alert('GAME OVER. Score: ' + score);
            location.reload();
        }
        drawMaze();
        
    }
    if(event.keyCode == 38){
        if(arr[playerPosition.x][playerPosition.y -1] == free){
            arr[playerPosition.x][playerPosition.y -1] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            walk();
        }
        else if(arr[playerPosition.x][playerPosition.y -1] == monster){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 10;
            score -= 10;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x][playerPosition.y-1] == diamond){
            arr[playerPosition.x][playerPosition.y-1] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            collect();
            point.value += 10;
            score += 42;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x ][playerPosition.y-1] == hul){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 30;
        }
        if(health.value == 0){
            alert('GAME OVER. Score: ' + score);
            location.reload();
        }
        drawMaze();  
    }

    if(event.keyCode == 39){
        if(arr[playerPosition.x +1][playerPosition.y] == free){
            arr[playerPosition.x +1][playerPosition.y] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            walk();
        }
        else if(arr[playerPosition.x +1][playerPosition.y] == monster){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 10;
            score -= 10;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x +1][playerPosition.y] == finish && point.value == 100){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            win();
            alert('TILLYKKE DU VANDT! Score: ' + score);
            point.value = 0;
            health.value = 30;
            location.reload();
        }
        else if(arr[playerPosition.x +1][playerPosition.y] == diamond){
            arr[playerPosition.x +1][playerPosition.y] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            collect();
            point.value += 10;
            score += 46;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x +1][playerPosition.y] == hul){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 30;
        }
        if(health.value == 0){
            alert('GAME OVER. Score: ' + score);
            location.reload();
        }
        drawMaze();
        
        
    }
    if(event.keyCode == 40){
        if(arr[playerPosition.x][playerPosition.y +1] == free){
            arr[playerPosition.x][playerPosition.y +1] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            walk();
        }
        else if(arr[playerPosition.x][playerPosition.y +1] == monster){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 10;
            score -= 10;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x][playerPosition.y +1] == diamond){
            arr[playerPosition.x][playerPosition.y +1] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            collect();
            point.value += 10;
            score += 21;
            document.getElementById("score").innerHTML = score;
        }
        else if(arr[playerPosition.x][playerPosition.y +1] == hul){
            arr[playerPosition.x,0][playerPosition.y,0] = player;
            arr[playerPosition.x][playerPosition.y] = free;
            dead();
            health.value -= 30;
        }
        if(health.value == 0){
            alert('GAME OVER. Score: ' + score);
            location.reload();
        }
        drawMaze();   
    }  
})
//Function der går ind og tager fat i vores restart knap og reloader siden når vi trykker på den.
document.getElementById("reset").onclick = function() {
    location.reload();
};

//Sikre os at banen bliver lavet når vi går ind på siden.
window.addEventListener("load", drawMaze);