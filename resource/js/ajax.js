$(document).ready(function () {
  /*
   * Evento que se ejecuta a la hora de guardar o actualizar informacion de alguna de las categorias
   */
  $("#btn-category").on("click", function () {
    var desc_img = document.getElementById("desc-img").value;
    var texto = document.getElementById("cont-category").value;
    var action = document.getElementById("type-action").value;
    var cat = document.getElementById("type-category").value;
    var img = document.getElementById("image").files[0];
    var formdata = new FormData(document.getElementById("form-category"));

    if (action == "update") {
      img = actualizarCategoria(img);
    }
    formdata.append("archivo", img);
    formdata.append("texto", texto);
    formdata.append("categoria", cat);
    formdata.append("desc_img", desc_img);

    $.ajax({
      url: "../../contenido/category/" + action,
      type: "post",
      data: formdata,
      contentType: false,
      processData: false,
      success: function (res) {
        var response = JSON.parse(res);
        if (response.ok) {
          location.reload(true);
        } else {
          $.jGrowl(response.error, {
            position: "bottom-right",
            header: "Fallo del Registro",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });

  function actualizarCategoria(img) {
    if (img != undefined) {
      return img;
    }
    return document.getElementById("img_principal").src.split("/").pop();
  }

  /*
   *  Evento sobre el formulario de cargar documentos que envia la informacion al servidor
   */
  $("#btn-load-doc").on("click", function () {
    var form = document.getElementById("form-load-doc");
    var formdata = new FormData(form);

    $.ajax({
      url: "../../contenido/documento/cargarDocumento",
      type: "post",
      data: formdata,
      processData: false,
      contentType: false,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Registro de documentos",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });

  /*
   * Evento que borra un documento de la DB y del servidor
   */
  $("body").on("click", ".btn-delete-doc", function () {
    var btn = $(this);
    var id = btn.data("id");
    var doc = btn.data("name");
    $.ajax({
      url: "../../documentos/delete",
      type: "post",
      data: {
        id: id,
        doc: doc,
      },
      success: function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl("No se ha podido eliminar el documento", {
            position: "bottom-right",
            header: "Registro de documentos",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });

  /*
   * Evento que elimina un integrante del personal
   */
  $("body").on("click", ".btn-delete-person", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.get("../../personal/delete/" + id, function (response) {
      var res = JSON.parse(response);
      if (res.ok) {
        //document.getElementById("person-"+id).remove();
        $(this).parent().parent().remove();
        location.reload(true);
      } else {
        $.jGrowl("No se puedo eliminar el recurso", {
          position: "bottom-right",
          header: "Eliminación fallida",
          theme: "bg-red",
          life: 5000,
        });
      }
    });
  });

  /*
   * Evento que actualiza la informacion del personal
   */
  $("#btn-update-per").on("click", function () {
    var form = document.getElementById("form-update-per");
    var formdata = new FormData(form);
    $.ajax({
      url: "../../actores/update",
      type: "post",
      data: formdata,
      processData: false,
      contentType: false,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });

  /*
   * Evento que se dispara a la hora de actualizar la formacion de un docente
   */
  $("#btn-update-estudy").on("click", function (e) {
    var form = document.getElementById("form-update-est");
    var formdata = new FormData(form);
    var action =
      document.getElementById("action").value == "register"
        ? "register"
        : "update";
    $.ajax({
      url: "../../estudios/" + action,
      type: "post",
      data: formdata,
      contentType: false,
      processData: false,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });
  /*
   * Evento que se dispara a la hora de actualizar un proyecto
   */
  $("#btn-update-proy").on("click", function (e) {
    var form = document.getElementById("form-update-proy");
    var formdata = new FormData(form);
    var action =
      document.getElementById("action2").value == "register"
        ? "register"
        : "update";
    $.ajax({
      url: "../../proyecto/" + action,
      type: "post",
      data: formdata,
      contentType: false,
      processData: false,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });

  /*
   * Evento que se dispara a la hora de borrar algun tipo de formacion del docente
   */
  $(".btn-delete-est").on("click", function () {
    var id = $(this).data("id");
    $.post("../../estudios/delete/", { id: id }, function (response) {
      var res = JSON.parse(response);
      if (res.ok) {
        location.reload(true);
      } else {
        $.jGrowl(res.error, {
          position: "bottom-right",
          header: "Ocurrio un problema",
          theme: "bg-red",
          life: 5000,
        });
      }
    });
  });

  /*
   * Evento que se dispara a la hora de borrar algun tipo de formacion del docente
   */
  $(".btn-delete-proy").on("click", function () {
    var id = $(this).data("id");
    $.post("../../proyecto/delete/", { id: id }, function (response) {
      var res = JSON.parse(response);
      if (res.ok) {
        location.reload(true);
      } else {
        $.jGrowl(res.error, {
          position: "bottom-right",
          header: "Ocurrio un problema",
          theme: "bg-red",
          life: 5000,
        });
      }
    });
  });

  /*
   * Evento que se dispara cuando se quiere guardar una subcategoria
   */
  $("#btn-subcategoria-save").on("click", function () {
    var form = document.getElementById("form-save-subcat");
    var formdata = new FormData(form);

    $.ajax({
      url: "../../categorias/registro_subcategoria",
      type: "post",
      data: formdata,
      contentType: false,
      processData: false,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });

  /*
   * Evento que se dispara cuando se desea eliminar una categoria
   */
  $("body").on("click", ".btn-delete-categorias", function () {
    var id = $(this).data("id");

    $.post("../../categorias/delete/", { id: id }, function (response) {
      var res = JSON.parse(response);
      if (res.ok) {
        location.reload(true);
      } else {
        $.jGrowl(res.error, {
          position: "bottom-right",
          header: "Ocurrio un problema",
          theme: "bg-red",
          life: 5000,
        });
      }
    });
  });
  /*
   * Evento que se dispara cuando se desea eliminar una categoria
   */
  $("body").on("click", ".btn-delete-cat", function () {
    var id = $(this).data("id_cat");

    $.post("../../categorias/delete_cat/", { id_cat: id }, function (response) {
      var res = JSON.parse(response);
      if (res.ok) {
        location.reload(true);
      } else {
        $.jGrowl(res.error, {
          position: "bottom-right",
          header: "Ocurrio un problema",
          theme: "bg-red",
          life: 5000,
        });
      }
    });
  });

  /**
   * Evento que se dispara cuando se seleciona una categoria
   */
  $("#tbl-cat").on("click", "tr", function () {
    var id = $(this).data("id");
    if (id !== undefined) {
      $.ajax({
        url: "../../categorias/getForCategories/",
        data: {
          id: id,
        },
        type: "post",
        success: function (response) {
          var res = JSON.parse(response);
          var html = "";
          var tbl = $("#tbl-subcat");
          var select = $("#subcategoria-id");
          $("#btn-subcat2").data("supercat", id);
          if (res.ok === undefined) {
            var btn = $("#btn-subcat");
            var html2 = "";
            for (obj of res) {
              html += `<tr style="cursor:pointer" data-sub="${obj.id}">
	   					  <td>${obj.nombre}</td>
	              <td><button data-id="${obj.id}" class="btn btn-danger btn-delete-categorias"><i class="fa fa-trash"></i></button></td>
	              <td><button data-id="${obj.id}" class="btn btn-danger" data-toggle="modal" data-target="#modal-categorias" data-categoria="0" id="btn-subcat_categorias" ><i class="fa fa-pencil"></i></button></td>
	   					</tr>`;
              html2 += `<option value="${obj.id}">${obj.nombre}</option>`;
            }
            btn.data("categoria", id);
          } else {
            html += `<tr>
	 						<td>No hay subcategorias registradas</td>
	 						<td></td>
	 					</tr>`;
            html2 = `<option value="">No hay subcategorias</option>`;
          }
          tbl.html(html);
          select.html(html2);
          btn.css("visibility", "visible");
        },
      });
    }
  });

  /*
   * Evento que se dispara cuando se desea eliminar una subcategoria
   */
  $("body").on("click", ".btn-del-subcat", function () {
    var id = $(this).data("id");

    $.post("../../categorias/deleteSubCat/", { id: id }, function (response) {
      var res = JSON.parse(response);
      if (res.ok) {
        location.reload(true);
      } else {
        $.jGrowl(res.error, {
          position: "bottom-right",
          header: "Ocurrio un problema",
          theme: "bg-red",
          life: 5000,
        });
      }
    });
  });

  /**
   * Evento que se dispara cuando se abre la venta modal de Registro
   * de nuevas categorias
   */
  $("#modal-categorias").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data("categoria"); // Extract info from data-* attributes
    var select = $("#categoria-id");
    var subcat2 = button.data("id");
    $("#categoria-id").val('');
    $("#sub_categoria").val('');
    $("#cont-category-secondary").val('');
    select.val(id);
    if(subcat2) {
      $.post(
        "../../categorias/get_sub_categori/",
        { id_sub_cat: subcat2 },
        function (response) {
          var res = JSON.parse(response);
          if (res.ok) {
            $("#categoria-id").val(res.data.id_categoria);
            $("#sub_categoria").val(res.data.nom_sub);
            $("#cont-category-secondary").val(res.data.descripcion);

          } else {
            $.jGrowl(res.error, {
              position: "bottom-right",
              header: "Ocurrio un problema",
              theme: "bg-red",
              life: 5000,  
            });
          }
        });
    }
  });

  /**
   * Evento que se diapara cuando se desea registrar una nueva categoria
   */
  $("#tbl-subcat").on("click", "tr", function () {
    var id = $(this).data("sub");
    if (id !== undefined) {
      $.ajax({
        url: "../../categorias/getForSubCategories/",
        data: {
          id: id,
        },
        type: "post",
        success: function (response) {
          var res = JSON.parse(response);
          var html = "";
          var tbl = $("#tbl-subcat2");
          var btn = $("#btn-subcat2");
          btn.data("categoria", id);
          if (res.ok === undefined && res.length > 0) {
            for (obj of res) {
              html += `<tr style="cursor:pointer">
	    					   <td>${obj.nombre}</td>
	                      <td><button data-id="${obj.id}" class="btn btn-danger btn-del-subcat"><i class="fa fa-trash"></i></button></td>
	    					</tr>`;
            }
            btn.data("categoria", id);
          } else {
            html += `<tr>
	  						<td>No hay subcategorias registradas</td>
	  						<td></td>
	  					</tr>`;
          }
          tbl.html(html);
          btn.css("visibility", "visible");
        },
      });
    }
  });

  /**
   * Evento que se dospara cuando se abre la venta modal de Registro
   * de nuevas subcategorias
   */
  $("#modal-subcategorias").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data("categoria"); // Extract info from data-* attributes
    var id2 = button.data("supercat");
    $("#subcategoria-id").val(id);
    $("#supercategoria-id").val(id2);
  });

  /*
   * Evento que se dispara cuando se quiere guardar una subcategoria
   */
  $("#btn-subcategoria-save2").on("click", function () {
    var form = document.getElementById("form-save-subcat2");
    var formdata = new FormData(form);

    $.ajax({
      url: "../../categorias/registro_sub_subcategoria/",
      type: "post",
      data: formdata,
      contentType: false,
      processData: false,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      },
    });
  });

  /*
   * Evento que se dispara cuando se desea eliminar una categoria de documento
   */
  $("body").on("click", ".btn-delete-doc-cat", function () {
    var id = $(this).data("id");

    $.post(
      "../../metadata/delete_documentos_categorias/",
      { id_doc_cat: id },
      function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      });
  });

  /*
   *  Evento sobre el formulario de guardar y actualizar categorias que envia la informacion al servidor
   */
  $("#btn-load-cat").on("click", function () {
    var id_doc_cap = $(this).data("id_doc_cap");
    var nombre_categoria = $("#nombre_categoria").val();
    if (!id_doc_cap) {
      $.post(
        "../../metadata/insert_documentos_categorias/",
        { nombre_categoria: nombre_categoria },
        function (response) {
          var res = JSON.parse(response);
          if (res.ok) {
            location.reload(true);
          } else {
            $.jGrowl(res.error, {
              position: "bottom-right",
              header: "Ocurrio un problema",
              theme: "bg-red",
              life: 5000,
            });
          }
        }
      );
    } else {
      $.post(
        "../../metadata/update_documentos_categorias/",
        { id_doc_cat: id_doc_cap, nombre_categoria: nombre_categoria },
        function (response) {
          var res = JSON.parse(response);
          if (res.ok) {
            location.reload(true);
          } else {
            $.jGrowl(res.error, {
              position: "bottom-right",
              header: "Ocurrio un problema",
              theme: "bg-red",
              life: 5000,
            });
          }
        }
      );
    }
  });

  /*
   *  Evento que abre la modal para la actualizacion de categorias de metadata.
   */
  $("body").on("click", ".btn-update-doc-cat", function () {
    var id = $(this).data("id");
    var nombreCategori = $(this).data("name");
    $("#nombre_categoria").val(nombreCategori);
    $("#btn-load-cat").data("id_doc_cap", id);
    $("#myModalDocCategori").modal("show");
  });


  $("body").on("click", "#modal-categorias-super-b", function () {
    var id = $(this).data("id_cat");
    $.post(
      "../../categorias/get_categori/",
      { id_cat: id },
      function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          console.log(res);
          $("#categoria-principal").val(res.data.nom_cat_prin);
          $("#cont-category-principal").val(res.data.descripcion);
          $("#btn-category-principal").data("id_cat_prin", res.data.id_cat_prin);
          //falta el id del boton data atributo
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      });
    $("#modal-categorias-super").modal("show");
  });

  /*
   *  Evento sobre el formulario de guardar y actualizar documentos de metadata que envia la informacion al servidor
   */
  $("#btn-load-doc-meta").on("click", function () {
    var id_doc_meta = $(this).data("id_doc_meta");
    var name_meta = $("#name_meta").val();
    if (!id_doc_meta) {
      $.post(
        "../../documentosMetadata/insert_documentos_metadata/",
        { name_meta: name_meta },
        function (response) {
          var res = JSON.parse(response);
          if (res.ok) {
            location.reload(true);
          } else {
            $.jGrowl(res.error, {
              position: "bottom-right",
              header: "Ocurrio un problema",
              theme: "bg-red",
              life: 5000,
            });
          }
        }
      );
    } else {
      $.post(
        "../../documentosMetadata/update_documentos_metadata/",
        { id_doc_meta: id_doc_meta, name_meta: name_meta },
        function (response) {
          var res = JSON.parse(response);
          if (res.ok) {
            location.reload(true);
          } else {
            $.jGrowl(res.error, {
              position: "bottom-right",
              header: "Ocurrio un problema",
              theme: "bg-red",
              life: 5000,
            });
          }
        }
      );
    }
  });

  /*
   * Evento que se dispara cuando se desea eliminar una categoria de documento
   */
  $("body").on("click", "#add_doc_metadata", function () {
    var id = $(this).data("id");

    $.post(
      "../../metadata/delete_documentos_categorias/",
      { id_doc_cat: id },
      function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          location.reload(true);
        } else {
          $.jGrowl(res.error, {
            position: "bottom-right",
            header: "Ocurrio un problema",
            theme: "bg-red",
            life: 5000,
          });
        }
      }
    );
  });
  /*
   * Evento que se dispara cuando se desea eliminar una categoria de documento
   */
  $("body").on("click", "#btn_add_doc_cat_meta", function () {
    var id = $("#btn_add_doc_cat_meta").data("id_doc_meta");
	  var name_metadata = $('#name_metadata').val();
	  var type = $('#id_meta_type').val();
    $.post(
      "../../metadata/add_metatada_of_categorie/",
      { id_cat: id,name_metadata : name_metadata,id_meta_type:type },
      function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
          $('#name_metadata').val('');
        	$.post(
				"../../metadata/get_metatada_of_categorie/",
				{ id_doc_cat: id },
				function (response) {
				  var res = JSON.parse(response);
					$("#id_doc_meta").empty();
          $("#id_doc_meta").append(
						`<option value="1">Integer</option>`
					);
          $("#id_doc_meta").append(
						`<option value="2">String</option>`
					);
          $("#id_doc_meta").append(
						`<option value="3">Date</option>`
          );
          $('#list_doc_metadata_asing').DataTable().destroy();
					$("#list_doc_metadata_asing > tbody").empty();
          $.each(res.data_asign, function (index, element) {
            var type = '';
            if(element.type == 1) {
              type = "Integer";
            }  else if(element.type == 2) {
              type = "String";
            } else if(element.type == 3) {
              type = "Date";
            }
            $("#list_doc_metadata_asing > tbody:last-child").append(`<tr>
            <td>${element.nombre}</td>
            <td>${element.name_meta}</td>
            <td>${type}</td>
            <td><button data-id_doc_cat_meta="${element.id_doc_cat_meta}"  class="btn btn-info btn-sm btn-delete-doc-cat_metadata"><i class="fa fa-trash"></i></button></td>
            </tr>`);
          });
          $('#list_doc_metadata_asing').DataTable();
        });
        }
        else {
        	$.jGrowl(res.error, {
        		position: "bottom-right",
        		header: "Ocurrio un problema",
        		theme: "bg-red",
        		life: 5000
        	});
        }
      }
    );
  });
  

  /*
   *  Evento que abre la modal para la actualizacion de documentos de metadata.
   */
  $("body").on("click", ".btn-update-doc-meta", function () {
    var id = $(this).data("id");
    var nombreDocMeta = $(this).data("name");
    $("#name_meta").val(nombreDocMeta);
    $("#btn-load-doc-meta").data("id_doc_meta", id);
    $("#myModalDocCategori").modal("show");
  });
  /*
   *  Evento que abre la modal para la actualizacion de documentos de metadata.
   */
  $("body").on("click", ".btn-add-doc-cat", function () {
    var id = $(this).data("id");
    $("#btn_add_doc_cat_meta").data("id_doc_meta", id);
    $.post(
      "../../metadata/get_metatada_of_categorie/",
      { id_doc_cat: id },
      function (response) {
	    	var res = JSON.parse(response);
          $("#id_doc_meta").empty();
          $("#id_doc_meta").append(
						`<option value="1">Integer</option>`
					);
          $("#id_doc_meta").append(
						`<option value="2">String</option>`
					);
          $("#id_doc_meta").append(
						`<option value="3">Date</option>`
          );
          $('#list_doc_metadata_asing').DataTable().destroy();
          $("#list_doc_metadata_asing > tbody").empty();
          $.each(res.data_asign, function (index, element) {
              var type = '';
              if(element.type == 1) {
                type = "Integer";
              }  else if(element.type == 2) {
                type = "String";
              } else if(element.type == 3) {
                type = "Date";
              }
              $("#list_doc_metadata_asing > tbody:last-child").append(`<tr>
              <td>${element.nombre}</td>
              <td>${element.name_meta}</td>
              <td>${type}</td>
              <td><button data-id_doc_cat_meta="${element.id_doc_cat_meta}"  class="btn btn-info btn-sm btn-delete-doc-cat_metadata"><i class="fa fa-trash"></i></button></td>
              </tr>`);
            });
            $('#list_doc_metadata_asing').DataTable();
            $("#add_metadata_doc").modal("show");
        }
    );
    
  });

  /*
   * Evento que se dispara cuando se desea eliminar una metada de una catagoria de documentos
   */
  $("body").on("click", ".btn-delete-doc-cat_metadata", function () {
    var id_doc_cat_meta = $(this).data("id_doc_cat_meta");

    $.post(
      "../../metadata/delete_documentos_categorias_metadata/",
      { id_doc_cat_meta: id_doc_cat_meta },
      function (response) {
        var res = JSON.parse(response);
        if (res.ok) {
			var id = $("#btn_add_doc_cat_meta").data("id_doc_meta");
			$.post(
				"../../metadata/get_metatada_of_categorie/",
				{ id_doc_cat: id },
				function (response) {
				  var res = JSON.parse(response);
					$("#id_doc_meta").empty();
					$("#id_doc_meta").append(
						`<option value="1">Integer</option>`
					);
          $("#id_doc_meta").append(
						`<option value="2">String</option>`
					);
          $("#id_doc_meta").append(
						`<option value="3">Date</option>`
          );
          $('#list_doc_metadata_asing').DataTable().destroy();
					$("#list_doc_metadata_asing > tbody").empty();
          $.each(res.data_asign, function (index, element) {
            var type = '';
            if(element.type == 1) {
              type = "Integer";
            }  else if(element.type == 2) {
              type = "String";
            } else if(element.type == 3) {
              type = "Date";
            }
            $("#list_doc_metadata_asing > tbody:last-child").append(`<tr>
            <td>${element.nombre}</td>
            <td>${element.name_meta}</td>
            <td>${type}</td>
            <td><button data-id_doc_cat_meta="${element.id_doc_cat_meta}"  class="btn btn-info btn-sm btn-delete-doc-cat_metadata"><i class="fa fa-trash"></i></button></td>
            </tr>`);
          });
          $('#list_doc_metadata_asing').DataTable();
        });
			}
		});
	});

	/*
	*  Evento sobre el formulario de guardar y actualizar categorias que envia la informacion al servidor
	*/
	$("#btn-load-cat").on("click", function() {
		var id_doc_cap = $(this).data("id_doc_cap");
		var nombre_categoria = $("#nombre_categoria").val();
		if (!id_doc_cap) {
			$.post('../../metadata/insert_documentos_categorias/', {nombre_categoria:nombre_categoria}, function(response){
				var res = JSON.parse(response);
					if (res.ok) {
						location.reload(true);
					}
					else {
						$.jGrowl(res.error, {
							position: "bottom-right",
							header: "Ocurrio un problema",
							theme: "bg-red",
							life: 5000
						});
					}
			});
		} else {
			$.post('../../metadata/update_documentos_categorias/', {id_doc_cat:id_doc_cap,nombre_categoria:nombre_categoria}, function(response){
				var res = JSON.parse(response);
					if (res.ok) {
						location.reload(true);
					}
					else {
						$.jGrowl(res.error, {
							position: "bottom-right",
							header: "Ocurrio un problema",
							theme: "bg-red",
							life: 5000
						});
					}
			});
		}
	});

	/*
	*  Evento que abre la modal para la actualizacion de categorias de metadata.
	*/
	$("body").on("click", ".btn-update-doc-cat", function(){
		var id = $(this).data("id");
		var nombreCategori = $(this).data("name");
		$("#nombre_categoria").val(nombreCategori);
		$("#btn-load-cat").data("id_doc_cap", id);
		$('#myModalDocCategori').modal('show');
	});
	
	/*
	*  Evento sobre el formulario de guardar y actualizar documentos de metadata que envia la informacion al servidor
	*/
	$("#btn-load-doc-meta").on("click", function() {
		var id_doc_meta = $(this).data("id_doc_meta");
		var name_meta = $("#name_meta").val();
		if (!id_doc_meta) {
			$.post('../../documentosMetadata/insert_documentos_metadata/', {name_meta:name_meta}, function(response){
				var res = JSON.parse(response);
					if (res.ok) {
						location.reload(true);
					}
					else {
						$.jGrowl(res.error, {
							position: "bottom-right",
							header: "Ocurrio un problema",
							theme: "bg-red",
							life: 5000
						});
					}
			});
		} else {
			$.post('../../documentosMetadata/update_documentos_metadata/', {id_doc_meta:id_doc_meta,name_meta:name_meta}, function(response){
				var res = JSON.parse(response);
					if (res.ok) {
						location.reload(true);
					}
					else {
						$.jGrowl(res.error, {
							position: "bottom-right",
							header: "Ocurrio un problema",
							theme: "bg-red",
							life: 5000
						});
					}
			});
		}
	});

	/*
	*  Evento que abre la modal para la actualizacion de documentos de metadata.
	*/
	$("body").on("click", ".btn-update-doc-meta", function(){
		var id = $(this).data("id");
		var nombreDocMeta = $(this).data("name");
		$("#name_meta").val(nombreDocMeta);
		$("#btn-load-doc-meta").data("id_doc_meta", id);
		$('#myModalDocCategori').modal('show');
	});

	 /*
	 * Evento que se dispara cuando se desea eliminar un documento de metadata
	 */
	$("body").on("click", ".btn-delete-doc-meta", function(){
		var id_doc_meta = $(this).data("id");

		$.post('../../documentosMetadata/delete_documentos_metadata/', {id_doc_meta:id_doc_meta}, function(response){
			var res = JSON.parse(response);
				if (res.ok) {
					location.reload(true);
				}
				else {
					$.jGrowl(res.error, {
						position: "bottom-right",
						header: "Ocurrio un problema",
						theme: "bg-red",
						life: 5000
					});
				}
		});
	});

  // registrar categoria principal
  $("#btn-category-principal").on("click", function () {
    // var desc_img = document.getElementById("desc-img").value; 
    var texto = document.getElementById("cont-category-principal").value;
    // var action = document.getElementById("type-action").value;
    var cat_name = document.getElementById("categoria-principal").value;
    var img = document.getElementById("image_principal").files[0];
    var id_categoria = $("#btn-category-principal").data("id_cat_prin");
    var formdata = new FormData(document.getElementById("form-save-categoria-principal"));

    // if (action == "update") {
    //   img = actualizarCategoria(img);
    // }
    formdata.append("archivo", img);
    formdata.append("cat_name", cat_name);
    formdata.append("texto", texto);
    // formdata.append("categoria", cat);
    // formdata.append("desc_img", desc_img);
    if(!id_categoria) {
      $.ajax({
        url: "../../categorias/registro_categoria",
        type: "post",
        data: formdata,
        contentType: false,
        processData: false,
        success: function (res) {
          var response = JSON.parse(res);
          if (response.ok) {
            location.reload(true);
          } else {
            $.jGrowl(response.error, {
              position: "bottom-right",
              header: "Fallo del Registro",
              theme: "bg-red",
              life: 5000,
            });
          }
        },
      });
    } else {
      formdata.append("id_categoria", id_categoria);
      $.ajax({
        url: "../../categorias/update_categoria",
        type: "post",
        data: formdata,
        contentType: false,
        processData: false,
        success: function (res) {
          var response = JSON.parse(res);
          if (response.ok) {
            location.reload(true);
          } else {
            $.jGrowl(response.error, {
              position: "bottom-right",
              header: "Fallo del Registro",
              theme: "bg-red",
              life: 5000,
            });
          }
        },
      });
    }
  });


  $("body").on("mouseenter", ".treeview-menu.menu-open li", function(e) {
    $(this).addClass("active");
  });

  $("body").on("mouseleave", ".treeview-menu.menu-open li", function(e) {
    $(this).removeClass("active");
  });
});
