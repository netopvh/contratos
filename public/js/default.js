$('#grid').DataTable({
    "language": {
        url: document.location.origin + "/plugins/datatables/pt_BR.json"
    }
});

//Faz as Validações das Casas
$("#casaForm").validate({
    rules: {
        nome: "required"
    },
    messages: {
        nome: {
            required: "O Nome é obrigatório!",
            minlength: "O Nome deve ter no mínimo 3 caracteres"
        }
    }
});

//Faz as Validações da permissão
$("#permissionForm").validate({
    rules: {
        name: "required",
        display_name: "required"
    },
    messages: {
        name: {
            required: "O Nome é obrigatório!",
            minlength: "O Nome deve ter no mínimo 3 caracteres"
        },
        display_name: {
            required: "O Nome de Exibição é obrigatório!"
        }
    }
});

//Faz as Validações da No Grupo de Permissão
$("#groupForm").validate({
    rules: {
        name: "required"
    },
    messages: {
        name: {
            required: "O Nome é obrigatório!",
            minlength: "O Nome deve ter no mínimo 3 caracteres"
        }
    }
});

//Faz as Validações das Roles
$("#roleForm").validate({
    rules: {
        name: "required",
        display_name: "required"
    },
    messages: {
        name: {
            required: "O Nome é obrigatório!",
            minlength: "O Nome deve ter no mínimo 3 caracteres"
        },
        display_name: {
            required: "O Nome de Exibição é obrigatório!"
        }
    }
});

//Faz Validações das Unidades
$("#unidadesForm").validate({
    rules: {
        nome: "required",
        email: "required",
        casa_id: "required"
    },
    messages: {
        nome: {
            required: "O Campo nome é obrigatório",
            minlength: "O Campo nome deve ter no mínimo 3 caracteres"
        },
        casa_id: {
            required: "O Campo casa é obrigatório",
        },
        email: {
            required: "O Campo email é obrigatório",
            email: "Insira um email Válido!"
        }
    }
});


//Efetua as Validações no Fomulario do Registro de Empresas
$("#empresaForm").validate({
    rules: {
        razao: "required",
        tipo_pessoa: "required",
        cpf_cnpj: "required",
        email: "email"
    },
    messages: {
        razao: {
            required: "A Razão Social é obrigatória!",
            minlength: "O Nome deve ter no mínimo 3 caracteres"
        },
        tipo_pessoa: {
            required: "Selecione o tipo de pessoa"
        },
        cpf_cnpj: {
            required: "O CPF/CNPJ é obrigatório!"
        },
        email: {
            email: "Insira um email válido!"
        }
    }
});

//Efetua as Validações no Fomulario do Registro de Contratos
$("#contratoForm").validate({
    rules: {
        numero: "required",
        ano: "required",
        casa_id: "required",
        empresa_id: "required",
        homologado: "required",
        executado: "required",
        data_inicio: "required",
        data_fim: "required",
        gestores: "required"
    },
    messages: {
        numero: {
            required: "Numero do Contrato é obrigatório!"
        },
        ano: {
            required: "Ano é obrigatório!"
        },
        casa_id: {
            required: "A Casa é Obrigatória!"
        },
        empresa_id: {
            required: "O Fornecedor é Obrigatório!"
        },
        homologado: {
            required: "Campo obrigatório!"
        },
        executado: {
            required: "Campo obrigatório!"
        },
        data_inicio: {
            required: "Obrigatório!"
        },
        data_fim: {
            required: "Obrigatório!"
        },
        gestores: {
            required: "Gestores é um campo Obrigatório!"
        }
    }
});

$("#aditivoForm").validate({
    rules: {
        ano: "required",
        homologado: "required",
        executado: "required",
        inicio: "required",
        fim: "required"
    },
    messages: {
        ano: {
            required: "Ano é obrigatório!"
        },
        homologado: {
            required: "Campo obrigatório!"
        },
        executado: {
            required: "Campo obrigatório!"
        },
        inicio: {
            required: "Campo obrigatório!"
        },
        fim: {
            required: "Campo obrigatório!"
        }
    }
});

//Configurações do Contrato Form

$('.select2').select2({
    theme: "bootstrap",
    language: 'pt-BR',
    placeholder: "Selecione uma opção",
    allowClear: true

});
$('#inicio').datepicker({
    autoclose: true,
    clearBtn: true,
    language: "pt-BR",
    format: 'dd/mm/yyyy'
});
$('#fim').datepicker({
    autoclose: true,
    clearBtn: true,
    language: "pt-BR",
    format: 'dd/mm/yyyy'
});

//FAZ AS VERIFICAÇÕES DAS EMPRESA
$(document).ready(function () {


    //Permite somente numeros
    $("#numero").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))                    {
            return false;
        }
    });
});