        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    let offcanvas = document.getElementById('sidePanelController');
    let extraspace = document.getElementById("extraspace");
    let mainSection = document.getElementById('mainSection');

    offcanvas.addEventListener('click',()=>{
        if (extraspace.style.display === "none") {
            extraspace.style.display = "block";
            mainSection.classList.remove('col-md-12');
            mainSection.classList.add('col-md-10');
        } else {
            extraspace.style.display = "none";
            mainSection.classList.remove('col-md-10');
            mainSection.classList.add('col-md-12');
        }
    });

</script>


</body>
</html>