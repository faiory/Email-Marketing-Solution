@section('footer')
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <p id="date"></p>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Maroon Frog Web Development</a>.</strong>
</footer>
<script>
    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = "Date " + m + "/" + d + "/" + y;
</script>



