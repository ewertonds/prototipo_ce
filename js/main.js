const form = document.querySelector("#mainForm");
console.log(form);
const servico = document.querySelector("#tipoServico");

document.addEventListener("DOMContentLoaded", function() {
  // Busque as opções da planilha e preencha o campo de seleção
  google.script.run.withSuccessHandler(function(options) {
    document.getElementById("nome").innerHTML = options;
  }).getFormOptions();
});

function habilitarTroca() {
    var tipoServicoSelect = document.getElementById("tipoServico");
    var campoHabilitadoInput = document.getElementById("habilita-troca");

    campoHabilitadoInput.disabled = (tipoServicoSelect.value !== "Troca");
}

/*const getGeolocation = async () => {
    if (!navigator.geolocation) {
      alert("Geolocalização é necessária");
      return;
    }
  
    let lat = 0;
    let long = 0;
  
    navigator.geolocation.getCurrentPosition(
      (position) => {
        lat = position.coords.latitude;
        long = position.coords.longitude;
      },
      () => {
        alert(
          "Geolocalização é necessária, atualize a página e permita o acesso"
        );
      },
      { timeout: 10000 }
    );
  
    while (lat == 0 && long == 0) {
      await new Promise((r) => setTimeout(r, 500));
    }
  
    return { lat, long };
  };
*/

function submitForm() {
  // Captura a localização GPS do usuário
  getLocation();
}

function limparForm() {
  document.getElementById("solicitacaoForm").reset();
}

function getLocation() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
          // Coordenadas de latitude e longitude
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;

          // Preenche os campos ocultos
          document.getElementById("latitude").value = latitude;
          document.getElementById("longitude").value = longitude;

          // Realize a geocodificação reversa usando a API Nominatim do OpenStreetMap
        const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;
            
        fetch(apiUrl)
          .then(response => response.json())
          .then(data => {
          // Exiba o endereço no console ou faça o que desejar com os dados
          console.log("Endereço: ", data.display_name);
        })
          .catch(error => {
          console.error("Erro ao obter o endereço:", error);
        });
      });   
  }
}


form.addEventListener("submit", async (event) => {
    event.preventDefault();
    const email = document.querySelector("#email");
    const cpf = document.querySelector("#cpf");
    const obs = document.querySelector("#comentarios");
  
    const entrada = document.querySelector("#entrada");
    const periodo = entrada.checked == true ? "Entrada" : "Saída";
  
    const geolocation = await getGeolocation();
  
    const validations = [
      email.value,
      cpf.value,
      cpf.value.length == 11,
      obs.value,
    ];
  
    const result = validations.every((validation) => validation);
  
    if (!result) 
    {
      alert("Preencha todos os campos corretamente");
    } else 
    {
      console.log({
        email: email.value,
        cpf: cpf.value,
        periodo,
        obs: obs.value,
        servico: servico.value,
        geolocation,
      });

      form.reset();
      alert("Formulário enviado com sucesso");
    }
  });
