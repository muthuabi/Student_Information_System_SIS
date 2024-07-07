function resp()
{
        console.log(window.innerWidth);
        if(window.innerWidth<888)
        {
            menutoggle.style.display="block";
            nav.classList.add("navbar-collapse");
            nav.classList.add("collapse");
            nav.classList.remove("navbar-expand");
        }
        else
        {
            menutoggle.style.display="none";
            nav.classList.add("navbar-expand");
            nav.classList.remove("navbar-collapse");
            nav.classList.remove("collapse");
        }
}
const nav=document.getElementById("mynav");
const menutoggle=document.getElementById("menu-toggle");
menutoggle.style.display="none";
    window.addEventListener("resize",(e)=>{
       resp();
    })
    window.addEventListener("load",(e)=>{
       resp();
    })
  
    menutoggle.addEventListener("click",(e)=>{
        nav.classList.toggle("collapse");
})
    