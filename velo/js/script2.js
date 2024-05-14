//global variables
var monthEl = $(".c-main");
var dataCel = $(".c-cal__cel");
var dateObj = new Date();
var month = dateObj.getUTCMonth() + 1;
var day = dateObj.getUTCDate();
var year = dateObj.getUTCFullYear();
var monthText = [
  "Janvier",
  "Février",
  "Mars",
  "Avril",
  "Mai",
  "Juin",
  "Juillet",
  "Août",
  "Septembre",
  "Octobre",
  "Novembre",
  "Décembre"
  ];
var indexMonth = month;
var todayBtn = $(".c-today__btn");
var addBtn = $(".js-event__add");
var saveBtn = $(".js-event__save");
var closeBtn = $(".js-event__close");
var winCreator = $(".js-event__creator");
var inputDate = $(this).data();
today = year + "-" + month + "-" + day;


// ------ set default events -------
function defaultEvents(dataDay,dataName,dataNotes,classTag){
  var date = $('*[data-day='+dataDay+']');
  date.attr("data-name", dataName);
  date.attr("data-notes", dataNotes);
  date.addClass("event");
  date.addClass("event--" + classTag);
}

defaultEvents(today, "AUJOURD'HUI",'Bonne journée','important');
defaultEvents('2024-01-01', "Jour de l'an",'Bonne année!','ferie');
defaultEvents('2024-04-01', 'Lundi de Pâques','','ferie');
defaultEvents('2024-05-01', 'Fête du travail','','ferie');
defaultEvents('2024-05-08', 'Victoire 1945','','ferie');
defaultEvents('2024-05-09', 'Ascension','','ferie');
defaultEvents('2024-05-20', 'Pentecôte','','ferie');
defaultEvents('2024-07-14', 'Fête national','','ferie');
defaultEvents('2024-08-15', 'Assomption','','ferie');
defaultEvents('2024-11-01', 'Toussaint','','ferie');
defaultEvents('2024-11-11', 'Armistice 1918','','ferie');
defaultEvents('2024-12-25', 'NOËL','Joyeuses fêtes','ferie');
defaultEvents('2024-12-31', "Réveillon du nouvel an",'','important');

defaultEvents('2024-01-23', "Conseil de classe",'CIEL-1','important');
defaultEvents('2024-01-25', "SNIR-2 : E5-2",'Evaluation','eval');
defaultEvents('2024-01-29', "SNIR-2 : E6-2",'Début des projets','officiel');
defaultEvents('2024-05-06', "CIEL-1 : Habilitation électrique",'Evaluation','eval');
defaultEvents('2024-05-07', "CIEL-1 : Habilitation électrique",'Evaluation','eval');
defaultEvents('2024-05-13', "CIEL-1 : Stage",'Départ en stage','officiel');
defaultEvents('2024-05-21', "Conseil de classe",'CIEL-1','important');

defaultEvents('2024-01-02', "Vacances de Noël",'','vacances');
defaultEvents('2024-01-03', "Vacances de Noël",'','vacances');
defaultEvents('2024-01-04', "Vacances de Noël",'','vacances');
defaultEvents('2024-01-05', "Vacances de Noël",'','vacances');
defaultEvents('2024-01-06', "Vacances de Noël",'','vacances');
defaultEvents('2024-01-07', "Vacances de Noël",'','vacances');

defaultEvents('2024-02-10', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-11', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-12', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-13', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-14', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-15', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-16', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-17', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-18', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-19', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-20', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-21', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-22', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-23', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-24', "Vacances d'hiver",'','vacances');
defaultEvents('2024-02-25', "Vacances d'hiver",'','vacances');

defaultEvents('2024-04-06', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-07', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-08', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-09', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-10', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-11', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-12', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-13', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-14', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-15', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-16', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-17', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-18', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-19', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-20', "Vacances de printemps",'','vacances');
defaultEvents('2024-04-21', "Vacances de printemps",'','vacances');

defaultEvents('2024-07-06', "Vacances d'été",'','vacances');
defaultEvents('2024-07-07', "Vacances d'été",'','vacances');
defaultEvents('2024-07-08', "Vacances d'été",'','vacances');
defaultEvents('2024-07-09', "Vacances d'été",'','vacances');
defaultEvents('2024-07-10', "Vacances d'été",'','vacances');
defaultEvents('2024-07-11', "Vacances d'été",'','vacances');
defaultEvents('2024-07-12', "Vacances d'été",'','vacances');
defaultEvents('2024-07-13', "Vacances d'été",'','vacances');
defaultEvents('2024-07-15', "Vacances d'été",'','vacances');
defaultEvents('2024-07-16', "Vacances d'été",'','vacances');
defaultEvents('2024-07-17', "Vacances d'été",'','vacances');
defaultEvents('2024-07-18', "Vacances d'été",'','vacances');
defaultEvents('2024-07-19', "Vacances d'été",'','vacances');
defaultEvents('2024-07-20', "Vacances d'été",'','vacances');
defaultEvents('2024-07-21', "Vacances d'été",'','vacances');
defaultEvents('2024-07-22', "Vacances d'été",'','vacances');
defaultEvents('2024-07-23', "Vacances d'été",'','vacances');
defaultEvents('2024-07-24', "Vacances d'été",'','vacances');
defaultEvents('2024-07-25', "Vacances d'été",'','vacances');
defaultEvents('2024-07-26', "Vacances d'été",'','vacances');
defaultEvents('2024-07-27', "Vacances d'été",'','vacances');
defaultEvents('2024-07-28', "Vacances d'été",'','vacances');
defaultEvents('2024-07-29', "Vacances d'été",'','vacances');
defaultEvents('2024-07-30', "Vacances d'été",'','vacances');
defaultEvents('2024-07-31', "Vacances d'été",'','vacances');




// ------ functions control -------

//button of the current day
todayBtn.on("click", function() {
  if (month < indexMonth) {
    var step = indexMonth % month;
    movePrev(step, true);
  } else if (month > indexMonth) {
    var step = month - indexMonth;
    moveNext(step, true);
  }
});

//higlight the cel of current day
dataCel.each(function() {
  if ($(this).data("day") === today) {
    $(this).addClass("isToday");
    fillEventSidebar($(this));
  }
});

//window event creator
addBtn.on("click", function() {
  winCreator.addClass("isVisible");
  $("body").addClass("overlay");
  dataCel.each(function() {
    if ($(this).hasClass("isSelected")) {
      today = $(this).data("day");
      document.querySelector('input[type="date"]').value = today;
    } else {
      document.querySelector('input[type="date"]').value = today;
    }
  });
});
closeBtn.on("click", function() {
  winCreator.removeClass("isVisible");
  $("body").removeClass("overlay");
});
saveBtn.on("click", function() {
  var inputName = $("input[name=name]").val();
  var inputDate = $("input[name=date]").val();
  var inputNotes = $("textarea[name=notes]").val();
  var inputTag = $("select[name=tags]")
  .find(":selected")
  .text();

  dataCel.each(function() {
    if ($(this).data("day") === inputDate) {
      if (inputName != null) {
        $(this).attr("data-name", inputName);
      }
      if (inputNotes != null) {
        $(this).attr("data-notes", inputNotes);
      }
      $(this).addClass("event");
      if (inputTag != null) {
        $(this).addClass("event--" + inputTag);
      }
      fillEventSidebar($(this));
    }
  });

  winCreator.removeClass("isVisible");
  $("body").removeClass("overlay");
  $("#addEvent")[0].reset();
});

//fill sidebar event info
function fillEventSidebar(self) {
  $(".c-aside__event").remove();
  var thisName = self.attr("data-name");
  var thisNotes = self.attr("data-notes");
  var thisImportant = self.hasClass("event--important");
  var thisEval = self.hasClass("event--eval");
  var thisOfficiel = self.hasClass("event--officiel");
  var thisFerie = self.hasClass("event--ferie");
  var thisVacances = self.hasClass("event--vacances");
  var thisEvent = self.hasClass("event");
  
  switch (true) {
  case thisImportant:
    $(".c-aside__eventList").append(
      "<p class='c-aside__event c-aside__event--important'>" +
      thisName +
      " <span> • " +
      thisNotes +
      "</span></p>"
      );
    break;
  case thisEval:
    $(".c-aside__eventList").append(
      "<p class='c-aside__event c-aside__event--eval'>" +
      thisName +
      " <span> • " +
      thisNotes +
      "</span></p>"
      );
    break;
  case thisOfficiel:
    $(".c-aside__eventList").append(
      "<p class='c-aside__event c-aside__event--officiel'>" +
      thisName +
      " <span> • " +
      thisNotes +
      "</span></p>"
      );
    break;
  case thisFerie:
    $(".c-aside__eventList").append(
      "<p class='c-aside__event c-aside__event--ferie'>" +
      thisName +
      " <span> • " +
      thisNotes +
      "</span></p>"
      );
    break;
  case thisVacances:
    $(".c-aside__eventList").append(
      "<p class='c-aside__event c-aside__event--vacances'>" +
      thisName +
      " <span> • " +
      thisNotes +
      "</span></p>"
      );
    break;
  case thisEvent:
    $(".c-aside__eventList").append(
      "<p class='c-aside__event'>" +
      thisName +
      " <span> • " +
      thisNotes +
      "</span></p>"
      );
    break;
  }
};
dataCel.on("click", function() {
  var thisEl = $(this);
  var thisDay = $(this)
  .attr("data-day")
  .slice(8);
  var thisMonth = $(this)
  .attr("data-day")
  .slice(5, 7);

  fillEventSidebar($(this));

  $(".c-aside__num").text(thisDay);
  $(".c-aside__month").text(monthText[thisMonth - 1]);

  dataCel.removeClass("isSelected");
  thisEl.addClass("isSelected");

});

//function for move the months
function moveNext(fakeClick, indexNext) {
  for (var i = 0; i < fakeClick; i++) {
    $(".c-main").css({
      left: "-=100%"
    });
    $(".c-paginator__month").css({
      left: "-=100%"
    });
    switch (true) {
    case indexNext:
      indexMonth += 1;
      break;
    }
  }
}
function movePrev(fakeClick, indexPrev) {
  for (var i = 0; i < fakeClick; i++) {
    $(".c-main").css({
      left: "+=100%"
    });
    $(".c-paginator__month").css({
      left: "+=100%"
    });
    switch (true) {
    case indexPrev:
      indexMonth -= 1;
      break;
    }
  }
}

//months paginator
function buttonsPaginator(buttonId, mainClass, monthClass, next, prev) {
  switch (true) {
  case next:
    $(buttonId).on("click", function() {
      if (indexMonth >= 2) {
        $(mainClass).css({
          left: "+=100%"
        });
        $(monthClass).css({
          left: "+=100%"
        });
        indexMonth -= 1;
      }
      return indexMonth;
    });
    break;
  case prev:
    $(buttonId).on("click", function() {
      if (indexMonth <= 11) {
        $(mainClass).css({
          left: "-=100%"
        });
        $(monthClass).css({
          left: "-=100%"
        });
        indexMonth += 1;
      }
      return indexMonth;
    });
    break;
  }
}

buttonsPaginator("#next", monthEl, ".c-paginator__month", false, true);
buttonsPaginator("#prev", monthEl, ".c-paginator__month", true, false);

//launch function to set the current month
moveNext(indexMonth - 1, false);

//fill the sidebar with current day
$(".c-aside__num").text(day);
$(".c-aside__month").text(monthText[month - 1]);