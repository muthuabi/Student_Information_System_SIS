let currentDate=new Date();
function generateCalendar() {
    const calendarElement = document.getElementById('calendar');

    const daysInMonth = new Date(currentDate.getFullYear(),currentDate.getMonth() + 1,0).getDate();
    const firstDayOfMonth = new Date(currentDate.getFullYear(),currentDate.getMonth()).getDay();
    calendarElement.innerHTML = '';
    const dayNames = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    for(let i=0; i<7; i++) {
        const dayNameElement = document.createElement('div');
        dayNameElement.classList.add('day','daytitle');
        dayNameElement.textContent = dayNames[i];
        calendarElement.appendChild(dayNameElement);
    }
    for(let i=0;i<firstDayOfMonth;i++)
    {
        const emptyDay=document.createElement("div");
        emptyDay.classList.add('day','empty');
        calendarElement.appendChild(emptyDay);
    }
    for(let day=1;day<=daysInMonth;day++)
    {
        const todaydate=new Date();
        const dayElement=document.createElement("div");
        if(day==todaydate.getDate() && currentDate.getDate()==todaydate.getDate()
         && currentDate.getMonth()==todaydate.getMonth() && currentDate.getFullYear()==todaydate.getFullYear())
         dayElement.style.backgroundColor="gray";
         dayElement.classList.add("day");
         dayElement.textContent=day;
         calendarElement.appendChild(dayElement);
    }
}
function updateMonthHead()
{
    const monthHead=document.getElementById("monthYear");
    const options={month:'long',year:'numeric'};
    monthHead.textContent=currentDate.toLocaleDateString('en-US',options);
}
function previousMonth()
{
    currentDate.setMonth(currentDate.getMonth()-1);
    generateCalendar();
    updateMonthHead();
}
function nextMonth()
{
    currentDate.setMonth(currentDate.getMonth()+1);
    generateCalendar();
    updateMonthHead();
}
function previousYear()
{
    currentDate.setFullYear(currentDate.getFullYear()-1);
    generateCalendar();
    updateMonthHead();
}
function nextYear()
{
    currentDate.setFullYear(currentDate.getFullYear()+1);
    generateCalendar();
    updateMonthHead();
}
generateCalendar();
updateMonthHead();