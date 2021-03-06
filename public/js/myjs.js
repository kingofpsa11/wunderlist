$(document).ready(function () {
  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
    //Display user settings
    $('.user').click(function (e) {
      e.preventDefault();
      $('#user-popover').toggle();
    });

    //Active tab in modal
    $('#modal li').on("click", function () {
      if (!$(this).hasClass("active")) {
        $('#modal .active').removeClass('active');
        $(this).addClass('active');
      }
    });
  
    //Display modal
    $('#account-settings').click(function (e) {
      e.preventDefault();
      $.ajax({
        type: "GET",
        url: "modal/accountSettings",
        dataType: "html",
        success: function (response) {
          let modal = $('#modal');
          modal.html(response);
          modal.show();
          $('#user-popover').hide();
        }
      })
    })

    //Click button Done hide modal
    $('#modal').on("click", 'button.full', function (e) {
      // e.preventDefault()
      $('#modal').hide();

      if ($('.listOptions-title').length) {
        let title = $('.listOptions-title').val();
        if (title != '') {
          $.post("list", { title: title, _method: "POST" },
            function (sidebar) {
              let sidebarItem = $.parseHTML(sidebar);
              $('.lists-collection').append(sidebarItem);
            },
            "html"
          )
        }
      }
    });

    // Create List in modal
    // Change List Name
    $('#modal').on("keyup", 'input.listOptions-title',function () {
      if ($(this).val() !== '') {
        $(this).parents('.content').find('button.blue').removeClass("cancel");
      } else {
        $(this).parents('.content').find('button.blue').addClass("cancel");
      }
    });
  
    // Create New List
    $('.sidebarActions-addList').on('click', function () {
      $.ajax({
        type: "GET",
        url: "modal/addList",
        dataType: "html",
        success: function (response) {
          let modal = $('#modal');
          modal.html(response);
          modal.show();
        }
      });
    });
  
    //Display more tab
    $('.tab.last-tab').click(function (e) {
      e.preventDefault();
      $('.actionBar-top').toggleClass('show');
    });
  
    //Add more task
    $('.addTask-input.chromeless').on("keydown", function (e) {
      if (e.keyCode === 13) {
        
        let title = $(this).val();
        let list_task_id = $('.sidebarItem.active').attr('rel');
        console.log(list_task_id)
        if (isNaN(list_task_id) === true) {
          list_task_id = 1;
          console.log(list_task_id);
        }
        let taskItem = $('ol.tasks:first .taskItem:first').clone();
        $(this).val('');

        $.ajax({
          type: "POST",
          url: "/task",
          data: { title: title, list_task_id: list_task_id },
          dataType: "text",
          success: function (id) {
            taskItem.find('.taskItem-titleWrapper').text(title);
            taskItem.find('.taskItem-duedate').text('');
            taskItem.attr("rel", id);
            $('ol.tasks:first').append(taskItem);
          }
        });
      }
    });
  
    //Show hide finished tasks
    $('.groupHeader:last').click(function (e) {
      $('.tasks:last').toggle();
    })


    //Check completed tasks
    $('.tasks').on("click", '.taskItem-checkboxWrapper', function (e) {
      e.stopPropagation();
      let taskItem = $(this).parents('.taskItem');
      changeTaskStatus(taskItem);
    });
    
    $('.top').on('click', '.detail-checkbox', function () {
      let taskItem = $('.taskItem.selected');
      changeTaskStatus(taskItem);
    });

    function changeTaskStatus(taskItem) {

      let id = taskItem.attr('rel');

      if (isNaN(id) === true) {
        id = 1;
      }

      $.post("task/" + id, { _method: "PUT" },
          function (data) {
            if (taskItem.hasClass("done")) {
              taskItem.removeClass("done");
              taskItem.find('.taskItem-checkboxWrapper span').replaceWith(data);
              taskItem.appendTo($('ol:first'));
              $('#detail .detail-checkbox').removeClass('checked');
            } else {
              taskItem.addClass("done");
              taskItem.find('.taskItem-checkboxWrapper span').replaceWith(data);
              taskItem.appendTo($('ol:last'));
              $('#detail .detail-checkbox').addClass('checked');
            }
          },
          "html"
      );
    }

    //Selected task
    $('.tasks').on('click', '.taskItem', function () {
      let task_id = $(this).attr('rel');
  
      if (!$(this).hasClass('selected')) {
        $('.selected').removeClass('selected');
        $(this).addClass('selected');
        
        $.get("task/" + task_id, { _method: "GET" },
          function (task) {
            //title
            $('#detail .top .title-container .display-view').text(task['title']);

            //status
            $('#detail .top .detail-checkbox').toggleClass( task.status===0 ? 'checked' : '');
            //duedate
            let due_date = (new Date(task['duedate'])).getTime();
            convertDate(due_date);
  
            //reminder date
            $('.detail-reminder .section-title').text(task['reminder_date']);
  
            //sub_tasks
            const listSubtasks = $('.subtasks ul');
            listSubtasks.html('');

            $.get("subtask/" + task_id,
              function (subTasks) {
                listSubtasks.html(subTasks);
              },
              "html"
            );

            //note
            $.get("note/" + task_id,
              function (note) {
                $('.section-item.note').html(note);
              },
              "html"
            );

            //file
            $.get('file/' + task_id,
                function (file) {
                  $('ul.files-list').html(file);
                }
            );

            //comments
            const listComments = $('.comments-list');
            listComments.html('');
            $.get("comment/" + task_id,
              function (comments) {
                listComments.append(comments);
              },
              "html"
            );
          },
          "json"
        );
      }
    });
  
    $('.tasks').on('dblclick', '.taskItem', function () {
      $('#detail').show();
    });
  
    //Display progress bar
    if ($('.taskItem').hasClass("selected")) {
      let count = $('.subtasks li').length;
      let countDone = $('.subtasks li').has('.checked').length;
      let width = countDone / count * 100 + "%";
      $('.taskItem.selected').find('.taskItem-progress-bar').css("width", width);
    }
  
    //Hide detail of task
    $('.detail-close').click(function (e) {
      e.preventDefault();
      $('#detail').hide();
    });
  
    //Collapsed nav bar
    $('.toggle-icon').on('click', function () {
      $('.navigation').toggleClass('collapsed');
    });
  
    $(window).resize(function () {
      if ($(window).innerWidth() <= 1000) {
        $('.navigation').addClass('collapsed');
      } else {
        $('.navigation').removeClass('collapsed');
      }
    });
  
    // Change right click context
    $('.tasks').on('contextmenu', '.taskItem', function (e) {
      
      e.preventDefault();
      const contextmenu = $('.context-menu');
      contextmenu.css({ "left": e.clientX, "top": e.clientY });
      contextmenu.show();

      //Check completed tasks
      const taskItem = $(this);
      contextmenu.off('click').on('click', '.context-menu-item:first', function () {

        let id = taskItem.attr("rel")
        $.post("task/" + id, { _method: "PUT" },
          function (data) {
            if (taskItem.hasClass("done")) {
              taskItem.removeClass("done");
              taskItem.find('.taskItem-checkboxWrapper').replaceWith(data);
              taskItem.appendTo($('ol:first'));
            } else {
              taskItem.addClass("done");
              taskItem.find('.taskItem-checkboxWrapper').replaceWith(data);
              taskItem.appendTo($('ol:last'));
            }
          },
          "html"
        )
      })
    });

    $(window).on('click', function () {
      const contextmenu = $('.context-menu');
      contextmenu.hide()
    });
  
    //Click active sidebarItem
    $('.lists-scroll').on('click', '.sidebarItem', function () {
      if (!$(this).is('.sidebarItem.active')) {
        $('.sidebarItem.active').removeClass('active');
        $(this).addClass('active');
      }

      $('#detail').hide();
  
      let title = $(this).find('.title').text();
      let list_id = $(this).attr('rel');
      if (isNaN(list_id) === true) {
        list_id = 1;
      }

      $('#list-toolbar').children('h1.title').text(title);
      let taskScroll = $('.task-list');
      taskScroll.removeClass();
      taskScroll.addClass('task-list ' + $(this).attr('rel'));
      $('ol.tasks').html('');

      $.ajax({
        type: "GET",
        url: 'uncompletedTasks/' + list_id,
        dataType: "html",
        success: function (tasks) {
          $('ol.tasks:first').append(tasks);
        }
      });

      $.ajax({
        type: "GET",
        url: 'completedTasks/' + list_id,
        dataType: "html",
        success: function (tasks) {
          $('ol.tasks:last').append(tasks);
        }
      });
    });
  
    //Date picker detail_date
    $('.detail-date').on('click', function () {
      let detailDate = $('.detail-date-input');
      detailDate.datepicker({
        showButtonPanel: true,
        onSelect: function () {
          let detail_date = new Date($(this).datepicker("getDate").getTime());
          let month = detail_date.getMonth() + 1;
          let year = detail_date.getFullYear();
          let day = detail_date.getDate();
          detail_date = year + '-' + ('0' + month).slice(-2) + '-' + ( '0' + day).slice(-2);

          let id = $('.selected').attr("rel");

          $.post("task/" + id, { datepicker: detail_date, _method: "PUT" },
            function () {
              convertDate(detail_date)
              $('.selected .taskItem-duedate').text(convertDateToVn(detail_date))
            }
          );
        }
      });
      detailDate.show().focus().hide();
    });
  
    //Display date in taskItem
    $('.taskItem').each(function () {
      let duedate = $(this).find('.taskItem-duedate').text()
      if (duedate != '') {
        duedate = (new Date(duedate)).getTime()
        duedate = convertDateToVn(duedate)
        $(this).find('.taskItem-duedate').text(duedate)
      }
    })
  
    function convertDate(timestamp) {
      if (timestamp != null) {
        timestamp = new Date(timestamp);
        let dateString;
        let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        let days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  
        let day = days[timestamp.getDay()];
        let month = months[timestamp.getMonth()];
        let date = timestamp.getDate();
  
        dateString = day + ', ' + month + ' ' + date;
        $('#detail .detail-date .section-title').text("Due on " + dateString);
      } else {
        $('#detail .detail-date .section-title').text("Set due date");
      }
    }
  
    // let detail_date = $('#detail .detail-date .section-title').text()
    // console.log(detail_date)
    // if (detail_date != '') {
    //   let dateString = convertDate(detail_date)
    //   $('#detail .detail-date .section-title').text("Due on " + dateString) 
    // }
  
    function convertDateToVn(timestamp) {
      timestamp = new Date(timestamp);
      let dateString;
      let date = timestamp.getDate();
      let month = timestamp.getMonth() + 1;
      let year = timestamp.getFullYear();
  
      dateString = ("0" + date).slice(-2) + '.' + ("0" + month).slice(-2) + '.' + year;
      return dateString;
    }
  
    function changeLanguage(lang) {
      $.post("Request.php", { lang: lang },
        function (data) {
          let setting = $('#settings .tabs ul')
          setting.find("[rel='general'] .tab-label").text(data["general"]);
          setting.find("[rel='account'] .tab-label").text(data["account"]);
          setting.find("[rel='shortcuts'] .tab-label").text(data["shortcuts"]);
          setting.find("[rel='smart_lists'] .tab-label").text(data["smart_lists"]);
          setting.find("[rel='notification'] .tab-label").text(data["notification"]);
          setting.find("[rel='about'] .tab-label").text(data["about"]);
        },
        "json"
      );
    }

    // if (detail_date.getFullYear() < now.getFullYear()) {
    //   detail_date_el.addClass("overdue")
    // } else if (detail_date.getFullYear() == now.getFullYear()) {
    //   if (detail_date.getMonth() < now.getMonth()) {
    //     detail_date_el.addClass("overdue")
    //   } else if (detail_date.getMonth() == now.getMonth()) {
    //     if (detail_date.getDate() < now.getDate()) {
    //       detail_date_el.addClass("overdue")
    //     } else {
    //       detail_date_el.removeClass("overdue")
    //       if (detail_date.getDate() == now.getDate()) {
    //         $('#detail .detail-date .section-title').contents().first()[0].textContent = "Due Today"
    //       }
    //     }
    //   } else {
    //     detail_date_el.removeClass("overdue")
    //   }
    // } else {
    //   detail_date_el.removeClass("overdue")
    // }
  
    //Add a subtask
    $('.section-item.subtask-add .section-content').on("click", function () {
      $(this).children('.section-title').addClass('hidden');
      $(this).children('.section-edit').removeClass('hidden');
      $(this).find('textarea').focus();
    })
  
    //Edit a subtask
    $('.subtasks ul').on('click', '.subtask .section-content', function () {
      $(this).find('.display-view').addClass('hidden');
      $(this).find('.edit-view').removeClass('hidden');
      let valueOfSubtask = $(this).find(' .display-view span').text();
      $(this).find('pre').text(valueOfSubtask);
      $(this).find('textarea').val(valueOfSubtask);
      $(this).find('textarea').focus();
    })
  
    $('.subtasks ul').on("focusout", "textarea", function () {
      $(this).parents('.content-fakable').children('.display-view').removeClass('hidden');
      $(this).parents('.content-fakable').children('.edit-view').addClass('hidden');
    })
  
    //addSubTask - Save a subtask by press Enter
    $('.subtasks textarea').on("keypress", function (e) {
      if (e.keyCode == 13) {
        let taskItem_id = $('.selected').attr('rel');
        let subtaskTitle = $(this).val();
        let ul = $(this).parents('.subtasks').children('ul');

        if ($(this).val() != '') {
          $.post("subtask", { _method: "POST", title: subtaskTitle, taskItem_id: taskItem_id },
            function (newSubtask) {
              ul.append(newSubtask);
            },
            "html"
          );
          $(this).val('')
        } else {
          $(this).val($(this).html());
          $(this).trigger("focusout");
        }
      }
    })
  
    //Check complete subtask
    $('.subtasks').on("click", '.checkBox', function () {
      let subtask_id = $('.selected').attr("rel");
      let checkBox = $(this);
      $.post("subtask/" + subtask_id, { _method: "PUT", action: 'changeStatus'},
        function () {
          checkBox.toggleClass("checked");
          checkBox.parents('.subtask').toggleClass("done");
        }
      );
    });
    
    //Add note
    let note = $('.note')

    note.on('click', function () {
      let content = $(this).find('.display-view span').text().trim();

      $(this).find('.note-add').addClass('hidden');
      $(this).find('.note-body').removeClass('hidden');
      $(this).find('.edit-view').removeClass('hidden');
      $(this).find('.display-view').addClass('hidden');

      if (content !== '') {
        $(this).find('textarea').val(content);
      }
      $(this).find('textarea').focus();
    });

    note.on('blur', 'textarea', function () {
      let content = $(this).val();
      let task_id = $('.taskItem.selected').attr('rel');

      if($(this).val() !== '') {
        $.ajax({
          type: "POST",
          url: "note",
          data: {content: content, _method: 'POST', task_id: task_id},
          success: function () {
            note.find('.edit-view').addClass('hidden');
            note.find('.display-view').removeClass('hidden');
            note.find('.display-view span').text(content);
          }
        });
      } else {
        note.find('.note-add').removeClass('hidden');
        note.find('.note-body').addClass('hidden');
        note.find('.edit-view').addClass('hidden');
        note.find('.display-view').removeClass('hidden');
      }

    });

    //Click to logout
    $('.logout').on('click', function (e) {
      document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
      window.location.href = "http://localhost/wunderlist-sass-file/login.php";
    });
  
    //change language
    $('#edit-language').on("change", function () {
      changeLanguage($('#edit-language').val());
    })
    changeLanguage($('#edit-language').val());
  
    //Uploadfile
    $('.section-item.files-add')[0].addEventListener("click", function (e) {
      e.stopPropagation();
      $(this).find('input').trigger("click");
    })
  
    $('.section-item.files-add input').on('change', function () {
      if ($(this).prop('files').length > 0) {
        $('#uploadFile').submit();
      }
    });
  
    $('#uploadFile').submit(function (e) {
      e.preventDefault();
      const file = $('.section-item.files-add input').prop('files')[0];
      const formdata = new FormData();
      let task_id = $('.taskItem.selected').attr('rel');
      formdata.append("file", file);
      formdata.append('task_id', task_id);
  
      $.ajax({
        type: "POST",
        url: "file",
        data: formdata,
        processData: false,
        cache: false,
        contentType: false,
        success: function (file) {
          $('ul.files-list').append(file)
        }
      })
    })

    //Add a comment
    $('.comments-add textarea').on('keypress', function(e){
      if (e.keyCode === 13) {
        let content = $(this).val();
        let ul = $('.comments-list');
        let task_id = $('.taskItem.selected').attr('rel');
        $.ajax({
          type: "POST",
          url: "comment",
          data: {content: content, _method: 'POST', task_id: task_id},
          dataType: 'html',
          success: function (comment) {
            ul.append(comment);
          }
        });
      }
    })
  })