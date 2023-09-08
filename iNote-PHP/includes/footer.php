<hr>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<p>d</p>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

<script>
edits = document.getElementsByClassName('edit');

Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
    })
})

deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
        sno = e.target.id.substr(1, );

        if (confirm("Are you sure you want to delete this note!")) {
            console.log("yes");
            window.location = `/php/iNote-PHP/index.php?delete=${sno}`;
            // TODO: Create a form and use post request to submit a form
        } else {
            console.log("no");
        }
    })
})
</script>

</body>

</html>