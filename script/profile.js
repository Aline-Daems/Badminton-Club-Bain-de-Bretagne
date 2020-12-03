
//Formatage de texte dans le créateur de texte
const simplemde = new SimpleMDE({ element: document.getElementById("userSignature") });

//Compteur de lettre pour le pseudo
const input = document.getElementById("username");
  const counter = document.getElementById("counter");
  document.getElementById("username").addEventListener("keyup", () => {						
    counter.innerText = `${input.value.length}/16`;
  });

  //confirm password
  document.getElementById("pwd-confirm").addEventListener("keyup",() => {
    const passwordOne = document.getElementById("pwd").value;
    const passwordTwo = document.getElementById("pwd-confirm").value;
    [... document.getElementsByClassName("password-input")].forEach(
      elt =>
        elt.style.borderColor =
          passwordOne !== passwordTwo ? "red" : "silver"
    );
  });