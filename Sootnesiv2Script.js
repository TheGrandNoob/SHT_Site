var i = -1 , b = 0 ;
    lasti = 0 ,lastb = 0;
    o = 0;
$(".Elemb").click(function()
{
    i = $(this).attr('i');
    if(i!=b)
    {
        lastb = $(this).attr("id");
    }
    else
    {
        lastb = $(this).attr("id");
        lasti = document.getElementById(lasti);
        lastb = document.getElementById(lastb);
        lastb.remove();
        lasti.remove();
        o+=1;
        if(o == 5)
        {
            window.location.replace("SotWin.php");
        }
    }
});
$(".Elemi").click(function()
{
    b = $(this).attr('b');
    if(i!=b)
    {
        lasti = $(this).attr("id");
    }
    else if (i==b)
    {
        lasti = $(this).attr("id");
        lasti = document.getElementById(lasti);
        lastb = document.getElementById(lastb);
        lastb.remove();
        lasti.remove();
        o+=1;
        if(o == 5)
        {
            window.location.replace("SotWin.php");
        }
    }
});

