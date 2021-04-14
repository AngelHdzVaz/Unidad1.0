function editorColaborador(){
  //AJAX GET
    const Ajax = new XMLHttpRequest();
    Ajax.open('GET', '/'+ nombre_empresa +'/colaboradores/lista');
    Ajax.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        let respuesta = JSON.parse(this.responseText);
        if(respuesta.estatus == 0) {
        } else if(respuesta.estatus == 1) {
          Swal.fire({
            title: respuesta.titulo,
            text: respuesta.mensaje,
      icon: respuesta.tipo
          });
        }
      }
    }
    Ajax.send();
}
