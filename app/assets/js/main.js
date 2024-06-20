let currentQuestionIndex = 0;
let quizDetails = [];
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
        clearTimeout(timer); // Arrête le minuteur si une réponse est sélectionnée

        if (index + 1 == answer) {
          // Ajoutez ici le code pour gérer une bonne réponse
          listItem.style.backgroundColor = "green";
          listItem.style.color = "white";
        } else {
          // Ajoutez ici le code pour gérer une mauvaise réponse
          listItem.style.backgroundColor = "red";
          listItem.style.color = "white";
        }
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
    // Démarre le minuteur pour cette question
    const timeLimitInSeconds = 20; // Temps limite en secondes par question
    const timerElement = document.createElement("div");
    quizContainer.appendChild(timerElement);
    startTimer(timeLimitInSeconds, timerElement);
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

// Fonction pour démarrer le minuteur
function startTimer(timeLimitInSeconds, timerElement) {
  let timeRemaining = timeLimitInSeconds;
  timerElement.textContent = `Temps restant: ${timeRemaining}s`;

  // Démarre l'intervalle pour le minuteur
  let timer = setInterval(() => {
    timeRemaining--;
    timerElement.textContent = `Temps restant: ${timeRemaining}s`;

    // Vérifie si le temps est écoulé
    if (timeRemaining <= 0) {
      clearInterval(timer); // Arrête le minuteur

      // Logique à exécuter lorsque le temps est écoulé

      // Passe à la question suivante
      currentQuestionIndex++;
      if (currentQuestionIndex < quizDetails.length) {
        showQuestion(currentQuestionIndex);
      } else {
        alert("Vous avez terminé le quiz !");
      }
    }
  }, 1000); // Intervalle d'une seconde (1000 ms)
}

// Attendre que le DOM soit chargé pour exécuter fetchQuiz
document.addEventListener("DOMContentLoaded", fetchQuiz);
