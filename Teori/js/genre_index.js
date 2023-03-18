function editGenre(id){
    window.location = "index.php?menu=genre_edit&gid=" + id;
}

function deleteGenre(id){
    const confirmation = window.confirm("are u sure want to delete"+
        "this data?");
    if(confirmation){
        window.location = "index.php?menu=genre&com=del&gid="+id;
}
}