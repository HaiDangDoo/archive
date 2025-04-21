document.addEventListener("DOMContentLoaded",()=>{
    const monthSelect=document.getElementById("month-select");
    const yearSelect=document.getElementById("year-select");
    const goBtn=document.getElementById("btn-go");
    const calenderContainer=document.getElementById("container-calender");
    const calenderBody=document.getElementById("body-calender");

    function loadCalender(month,year){
        const xhttp=new XMLHttpRequest();
        xhttp.open("GET",`calender.php?month=${month}&year=${year}`,true);
        xhttp.onload=function(){
            if(this.status===200){
                const res=JSON.parse(this.responseText);
                calenderBody.innerHTML = res.dayHTML;
                calenderContainer.style.display="block";

            }
        }
        xhttp.send();
    }
    goBtn.addEventListener("click",()=>{
        const selectMonth=monthSelect.value;
        const selectYear=yearSelect.value;
        loadCalender(selectMonth,selectYear);
    });
});