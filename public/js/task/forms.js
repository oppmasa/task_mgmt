function onDeleteConfirm(){
    let check_confirm = window.confirm("削除しますか？")
    if(check_confirm){

        document.getElementById("delete_form").submit();
    }
}
function onSubmit(){
    document.getElementById("submit_form").submit();
}

