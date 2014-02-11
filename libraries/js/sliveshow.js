var SLIDE_path = 'http://localhost/iLand_Agency_Web_thang12/Source/images/hinh/';
var SLIDE_text = new Array();

SLIDE_text[1]  = 'Everythings fine! The turkey is in the microwawe, and Im feeding baby Fritz'; // Text to Image 1
SLIDE_text[2]  = 'I would like a surprise-balloon...'; // Text to Image 2
SLIDE_text[3]  = 'Nudist-Beach'; // Text to Image 3
SLIDE_text[4]  = 'Honey, I have a confession... I have another woman'; // Text to Image 4
SLIDE_text[5]  = 'The worst job'; // Text to Image 5

// Don't change anything under here...

var SLIDE_pic = new Array();
var SLIDE_load = new Array();
var SLIDE_status, SLIDE_timeout;
var SLIDE_actual = 1;
var SLIDE_speed = 1000;
var SLIDE_fade = 2;

for (i = 1; i <= SLIDE_text.length-1; i++)
{
  SLIDE_pic[i] = SLIDE_path+i+'.jpg';
  SLIDE_load[i] = new Image();
  SLIDE_load[i].src = SLIDE_pic[i];
}
var SLIDE_count = SLIDE_pic.length-1;

function SLIDE_start()
{
  document.getElementById('SLIDE_pause').disabled = true;
  document.images.SLIDE_picBox.src = SLIDE_load[SLIDE_actual].src;
  document.getElementById("SLIDE_textBox").innerHTML= SLIDE_text[SLIDE_actual];
}

function SLIDE_play()
{
  document.getElementById('SLIDE_play').disabled = true;
  document.getElementById('SLIDE_pause').disabled = false;
  SLIDE_actual++;
  SLIDE_slide();
  SLIDE_status = 'SLIDE_play';
  SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
}

function SLIDE_pause()
{
  clearTimeout(SLIDE_timeout);
  SLIDE_status = 'SLIDE_pause';
  document.getElementById('SLIDE_pause').disabled = true;
  document.getElementById('SLIDE_play').disabled = false;	
}

function SLIDE_back()
{
  clearTimeout(SLIDE_timeout);
  SLIDE_actual--;
  SLIDE_slide();
  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
}

function SLIDE_forward()
{
  clearTimeout(SLIDE_timeout);
  SLIDE_actual++;
  SLIDE_slide()
  if (SLIDE_status != 'SLIDE_pause') SLIDE_timeout = setTimeout("SLIDE_play()",SLIDE_speed);
}


function SLIDE_slide()
{
  if (SLIDE_status != 'SLIDE_pause')
  {
    document.getElementById('SLIDE_play').disabled = true;
    document.getElementById('SLIDE_pause').disabled = false;
  }
  if (SLIDE_actual > (SLIDE_count)) SLIDE_actual=1;
  if (SLIDE_actual < 1) SLIDE_actual = SLIDE_count;
  if (document.all)
  {
    document.getElementById("SLIDE_textBox").style.background = "transparent";
    document.images.SLIDE_picBox.style.filter="blendTrans(duration=2)";
    document.images.SLIDE_picBox.style.filter="blendTrans(duration=SLIDE_fade)";
    document.images.SLIDE_picBox.filters.blendTrans.Apply();
  }
  document.images.SLIDE_picBox.src = SLIDE_load[SLIDE_actual].src;
  if (document.getElementById) document.getElementById("SLIDE_textBox").innerHTML= SLIDE_text[SLIDE_actual];
  if (document.all) document.images.SLIDE_picBox.filters.blendTrans.Play();
}

function SLIDE_speeds(SLIDE_valgt)
{
  SLIDE_speed = SLIDE_valgt.options[SLIDE_valgt.selectedIndex].value;
}
function test()
{
	alert('test');
}
