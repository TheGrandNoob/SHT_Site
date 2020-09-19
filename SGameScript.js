var PhotoNumBuffer = 0 ,TextNumBuffer = 1 , lastPhoto,lastText;
var TextBuffer = [
    "Библиотека им. М.Ю. Лермонтова" , "Начальное женское училище",
    "церковь Св. Петра и Павла","Храм Сергиевской церкви с. Головинщино",
    "Школа в с. Большая Лука Вадинского района","Керенский Тихвинский монастырь",
    "Больница им. Семашко (ранее больница при общине сестер милосердия)",
    "Городская инфекционная больница (ранее богадельня)","Ремесленная школа",
    "Кинотеатр Олимп (ныне Октябрь)","Успенский кафедральный собор"
    ];
var Answers = [
    1,2,3,4,5,6,7,8,9,10,11,12
];
RandTextesAndAnswers();
function CheckNumInArr( Array , num)
{
    var i = 0,gut = false;
    var ArrSize = Array.length;
    while((!gut)&&(i<ArrSize))
    {
        if(Array[i]==num)
        {
            gut=true;
            return true;
        }
        else
            i++;
        i++;
    }
    delete i , gut , ArrSize;
    return num;
}
function RandTextesAndAnswers()
{
    var ArrSize = TextBuffer.length;
    var UsedS = [0,0,0,0,0,0,0,0,0,0,0] ,NB, TextBufferN;
    for(var i = 0 ; i < ArrSize ; i++)
    {
        NB = CheckNumInArr( UsedS,Math.floor(Math.random()*(ArrSize+1)));
        if(NB)
            i--;
        else
            UsedS[i]=NB;
    }
    alert(UsedS);
}
$(".Block").click(function()
{
    if($(this).attr('type') == 'photo')
    {
        lastPhoto = $(this).attr("id");
        PhotoNumBuffer =$(this).attr("otvet")
    }
    else if($(this).attr('type') == 'Text')
    {
        lastText = $(this).attr("id");
        TextNumBuffer =$(this).attr("otvet")
    }
    if(PhotoNumBuffer==TextNumBuffer)
    {
        var idP = lastPhoto;
        var $this = document.getElementById(idP);
        $this.style.background  ="blue";
        delete idP;

        var idT = lastText;
        $this = document.getElementById(idT);
        $this.style.background  ="blue";
        delete idT;
    }
    alert(TextBuffer[1]);
})