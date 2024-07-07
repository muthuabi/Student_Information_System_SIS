const tdata=document.querySelectorAll("#student_table tr:not(:first-child)");
const search=document.getElementById("input-search");
const searchbtn=document.getElementById("search-btn");
const match = document.getElementById("nomatch");
const matches = document.getElementById("matches");
matches.style.display="none";
let count;
function searching(e)
{
    count=0;
    tdata.forEach(element=>{
        element.style.display="none";
        if(element.innerHTML.toUpperCase().match(e.value.trim().toUpperCase()))
        {
            element.style.display="table-row";
            count++;
			
        }
    })
	matches.style.display="block";
	match.innerHTML=count;
}
searchbtn.addEventListener("click",(e)=>{
    searching(search);
})
search.addEventListener("keyup",(e)=>{
	console.log(e.key);
	if(e.key=="Enter")
	{
			 searching(search);
	}
	if(e.target.value.trim()=="")
	{
		matches.style.display="none";
		tdata.forEach(element=>{
            element.style.display="table-row";
        })
	}
}
);