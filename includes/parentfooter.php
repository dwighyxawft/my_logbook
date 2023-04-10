<footer class="bg-dark">
    <p class="text-center py-4 text-light">
        Designed and Developed by xawft &copy; Copyrights reserved 2022
    </p>
</footer>
<script>
    if(typeof(linkId) == "undefined"){
        console.log("No link");
    }
    else{
        var links = document.querySelectorAll(".links");
        links.forEach(function(link){
            link.classList.remove("active");
            if(link.getAttribute("data-link") == linkId){
                link.classList.add("active");
            }
        })
    }
    
</script>
</body>
</html>