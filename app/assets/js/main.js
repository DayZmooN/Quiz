let currentQuestionIndex = 0;
let quizDetails = [];
let compteurGood = 0;

// Requête pour récupérer tous les quiz par id
async function fetchQuiz() {
  try {
    const quizIdElements = document.querySelectorAll(".quiz-id");

    // Itérer sur tous les éléments avec la classe quiz-id
    for (const element of quizIdElements) {
      const id = element.dataset.id;
      console.log("Quiz ID:", id);

      try {
        // Requête pour récupérer les détails du quiz
        const quizResponse = await fetch(
          `/quiz/app/model/game/fetch_quiz_details.php?id=${id}`
        );

        if (!quizResponse.ok) {
          throw new Error(`HTTP error! Status: ${quizResponse.status}`);
        }

        const quizResult = await quizResponse.json();

        // Vérifier si quizResult est défini et non vide
        if (Object.keys(quizResult).length === 0) {
          throw new Error(`Aucun détail de quiz trouvé pour l'ID ${id}`);
        }

        console.log("Quiz détails:", quizResult);

        // Appeler la fonction pour afficher les détails du quiz
        // Stocker les détails du quiz
        quizDetails = quizResult;
        showQuestion(currentQuestionIndex);
      } catch (error) {
        console.error("Erreur lors de la récupération des données :", error);
      }
    }
  } catch (error) {
    console.error("Erreur lors de la récupération du quiz :", error);
  }
}

// Fonction pour afficher les détails du quiz et ses questions
function showQuestion(index) {
  const quizContainer = document.getElementById("quiz-container");
  if (!quizContainer) {
    console.error("Element #quiz-container n'existe pas dans le DOM.");
    return;
  }
  quizContainer.innerHTML = "";
  if (quizDetails.length > 0) {
    const question = quizDetails[index];
    console.log(question);
    const questionTitle = document.createElement("h2");
    questionTitle.textContent = question.name;
    quizContainer.appendChild(questionTitle);

    const options = JSON.parse(question.options);

    options.forEach((option, index) => {
      const listItem = document.createElement("button");
      listItem.classList.add("btn", "btn-outline-primary");
      listItem.textContent = option;
      listItem.addEventListener("click", async () => {
        const answer = await checkAnswer(question.question_id);
        if (index + 1 == answer) {
          // Ajoutez ici le code pour gérer une bonne réponse
          listItem.style.backgroundColor = "green";
          listItem.style.color = "white";
          compteurGood++;
        } else {
          // Ajoutez ici le code pour gérer une mauvaise réponse
          listItem.style.backgroundColor = "red";
          listItem.style.color = "white";
        }
        document.getElementById("score").textContent = compteurGood;
        setTimeout(() => {
          currentQuestionIndex++;
          if (currentQuestionIndex < quizDetails.length) {
            showQuestion(currentQuestionIndex);
          } else {
            endQuiz();
          }
        }, 300);
      });

      quizContainer.appendChild(listItem);
    });
  }
}

// Fonction pour vérifier la réponse sélectionnée par l'utilisateur
async function checkAnswer(questionId) {
  try {
    console.log(questionId);
    const response = await fetch(
      `/quiz/app/model/game/fetch_question_reponse.php?id=${questionId}`
    );
    const result = await response.json();
    console.log("Réponse serveur", result.correctAnswer);

    return result.correctAnswer;
  } catch (error) {
    console.error("Erreur lors de la vérification de la réponse :", error);
    return false; // En cas d'erreur, considérer la réponse comme incorrecte
  }
}

function endQuiz() {
  const quizContainer = document.querySelector("#quiz-container");
  quizContainer.innerHTML = "";
}

// Attendre que le DOM soit chargé pour exécuter fetchQuiz
document.addEventListener("DOMContentLoaded", fetchQuiz);
