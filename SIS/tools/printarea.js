
        function printSection(id='print-area')
        {
            const section=document.getElementById(id).innerHTML;
            document.body.innerHTML=section;
            window.print();
            location.reload();
        }
