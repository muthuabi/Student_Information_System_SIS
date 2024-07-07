function setcookiejs(name,value,exp=0)
{
    console.log("working");
    let d=new Date();
    d.setTime(d.getTime()+(exp*24*60*60*1000));
    let expire=d.toUTCString();
    document.cookie=""+name+"="+value+";expires="+expire;
}
