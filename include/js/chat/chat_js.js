var last_chat = "";
var last_date = "";
var week = new Array(
  "일요일",
  "월요일",
  "화요일",
  "수요일",
  "목요일",
  "금요일",
  "토요일"
);
var chat_buff = "";

$(document).ready(function (e) {
  try {
    localStorage.setItem("chat_" + chat_user_id, true);

    window.onbeforeunload = function (e) {
      localStorage.setItem("chat_" + chat_user_id, false);
    };
  } catch (error) {}

  var objDiv = document.getElementById("chat_area");
  objDiv.scrollTop = objDiv.scrollHeight;

  if (navigator.userAgent.indexOf("Firefox") >= 0) {
    /*  파폭용 */
    var eventNames = "keydown";

    window.addEventListener(
      eventNames,
      function (e) {
        window.event = e;
      },
      true
    );
  }

  chat_fist_load();

  $("#chat_submit").click(function () {
    chat_text = $("#chat_text").val();
    m_userid = $("#user_id").val();

    if (chat_text == "") {
      return false;
    } else {
      $.ajax({
        type: "POST",
        url: "/chat/chatting_submit",
        data: {
          user_id: encodeURIComponent(m_userid),
          contents: encodeURIComponent(chat_text),
        },
        cache: false,
        async: false,
        success: function (data) {
          result = data;
        },
      });

      if (result == "not-ready") {
        alert("아직 상대방이 채팅을 수락하지 않았습니다.");
      } else if (result == "deny") {
        alert("상대방이 채팅을 거절하였습니다.");
      } else if (result == "not-login") {
        alert("로그인 상태가 아닙니다. 다시 로그인해주세요.");
        opener.location.reload();
      } else if (result == "exit") {
        alert("상대방이 채팅방을 나갔습니다.\n더이상 채팅이 불가능합니다.");
      } else if (result == "bad") {
        alert("상대방이 나쁜친구로 등록하셨습니다.");
        return;
      } else {
        //나의 채팅 내용 삽입
        var now = new Date();
        reg_date = make_time(now.getHours(), now.getMinutes());

        var datas = new Array();
        datas["mode"] = "chat";
        datas["contents"] = chat_text;
        datas["idx"] = result;
        datas["read_cnt"] = 1;
        add_chat_send(datas, reg_date);
      }
    }
  });
});

function chat_fist_load() {
  user_id = $("#user_id").val();
  $.get(
    "/chat/hook_get_chat_first_load/" + user_id + "/" + Math.random(),
    function (data) {
      if (data.length > 3) {
        $.each(data.split("¶"), function (index, x1) {
          datas = {};
          $.each(x1.split("|"), function (index, x2) {
            var arr = x2.split("=");
            arr[1] && (datas[arr[0]] = decodeURIComponent(arr[1]));
          });

          tmp_data1 = datas["reg_date"].split(" ");
          tmp_data2 = tmp_data1[1].split(":");

          reg_date = make_time(tmp_data2[0], tmp_data2[1]);

          if (datas["send_id"] == user_id) {
            add_chat_recv(datas, reg_date, true);
          } else {
            add_chat_send(datas, reg_date, true);
          }
        });

        document.getElementById("add_chat").innerHTML = chat_buff;
        var objDiv = document.getElementById("chat_area");
        objDiv.scrollTop = objDiv.scrollHeight;
        chat_buff = "";
      }
    }
  );
}

function add_chat_send(datas, reg_date, buffer) {
  var chat_add_table = "";

  if (buffer == true) {
    tmp = datas["reg_date"].split(" ");

    tmp1 = tmp[0].split("-");
    tmp2 = tmp[1].split(":");

    var now = new Date(
      tmp1[0],
      tmp1[1] - 1,
      tmp1[2],
      tmp2[0],
      tmp2[1],
      tmp2[2]
    );
    var today =
      now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate();
  } else {
    var now = new Date();
    var today =
      now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate();
  }

  if (last_date != today) {
    //날짜넣기
    chat_add_table +=
      "<div class='day_area'><span class='day_text'>" +
      now.getFullYear() +
      "년 " +
      (now.getMonth() + 1) +
      "월 " +
      now.getDate() +
      "일 " +
      week[now.getDay()] +
      "</span></div>";
    last_date = today;
  } else if (last_chat != "send" && last_chat != "") {
    //공백주기
    chat_add_table += "<div class='div_common'></div>";
  }

  if (datas["mode"] == "chat" || datas["mode"] == "chat_req") {
    //일반채팅
    last_chat = "send";
    chat_add_table += "<div class='div_common'>";
    chat_add_table += "<table class='float_right'>";
    chat_add_table += "<tr><td class='clock_td text-right padding_right_7'>";
    chat_add_table +=
      "<p class='read_cnt' id='chat_read_cnt_" +
      datas["idx"] +
      "'> " +
      datas["read_cnt"] +
      " </p> " +
      reg_date;
    chat_add_table += "</td>";
    chat_add_table += "<td><div class='send_chat'>";
    chat_add_table += htmlspecialchars(datas["contents"]);
    chat_add_table += "</div><div class='send_arrow'></div>";
    chat_add_table += "</td></tr></table>";
    chat_add_table += "<div class='clear'></div>";
    chat_add_table += "<div id='add_chat'></div>";
    chat_add_table += "</div>";
  } else if (datas["mode"] == "gift") {
    last_chat = "send";
    chat_add_table += call_chat_list_view(
      "send",
      datas["contents"],
      datas["recv_id"]
    );
  } else if (datas["mode"] == "gift_req") {
    last_chat = "send";
    chat_add_table += call_chat_list_view_req(
      "send",
      datas["contents"],
      datas["recv_id"]
    );
  }

  if (buffer == true) {
    chat_buff += chat_add_table;
  } else {
    document.getElementById("add_chat").innerHTML += chat_add_table;
  }

  $("#chat_text").val("");

  var objDiv = document.getElementById("chat_area");
  objDiv.scrollTop = objDiv.scrollHeight;
}

function add_chat_recv(datas, reg_date, buffer) {
  var chat_add_table = "";

  tmp = datas["reg_date"].split(" ");
  tmp1 = tmp[0].split("-");
  tmp2 = tmp[1].split(":");
  var now = new Date(tmp1[0], tmp1[1] - 1, tmp1[2], tmp2[0], tmp2[1], tmp2[2]);
  var today =
    now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate();

  if (last_date != today) {
    //날짜넣기
    chat_add_table +=
      "<div class='day_area'><span class='day_text'>" +
      now.getFullYear() +
      "년 " +
      (now.getMonth() + 1) +
      "월 " +
      now.getDate() +
      "일 " +
      week[now.getDay()] +
      "</span></div>";
    last_date = today;
  } else if (last_chat != "recv" && last_chat != "") {
    //공백주기
    chat_add_table += "<div class='div_common'></div>";
  }

  if (datas["mode"] == "chat" || datas["mode"] == "chat_req") {
    last_chat = "recv";
    chat_add_table += "<div class='div_common message_box'>";
    chat_add_table += decodeURIComponent(datas["user_pic"]);
    chat_add_table += "<table cellpadding='0' cellspacing='0' border='0'>";
    chat_add_table += "<tr><td >";
    chat_add_table += "<div class='recv_arrow'></div>";
    chat_add_table += "<div class='recv_chat'>";
    chat_add_table += htmlspecialchars(datas["contents"]);
    chat_add_table += "</div></td>";
    chat_add_table += "<td class='clock_td padding_left_7'>" + now_time;
    chat_add_table += "</td></tr></table></div>";
  } else if (datas["mode"] == "request") {
    chat_add_table += "<div class='div_common chat_ok color_333'>";
    chat_add_table += "	- " + datas["contents"] + " -";
    chat_add_table += "</div>";
  } else if (datas["mode"] == "accept") {
    chat_add_table += "<div class='div_common chat_ok color_ea3c3c'>";
    chat_add_table += "	- " + datas["contents"] + " -";
    chat_add_table += "</div>";
    $(".chat_result").hide();
    $(".chat_text_area").show();
  } else if (datas["mode"] == "deny") {
    chat_add_table += "<div class='div_common chat_ok color_ea3c3c'>";
    chat_add_table += "	- " + datas["contents"] + " -";
    chat_add_table += "</div>";
  } else if (datas["mode"] == "exit") {
    chat_add_table += "<div class='div_common chat_ok color_ea3c3c'>";
    chat_add_table += "	- " + datas["contents"] + " -";
    chat_add_table += "</div>";
    $(".chat_result").show();
    $(".chat_text_area").hide();
  } else if (datas["mode"] == "exit2") {
    chat_add_table += "<div class='div_common chat_ok color_ea3c3c'>";
    chat_add_table += "	- " + datas["contents"] + " -";
    chat_add_table += "</div>";
  } else if (datas["mode"] == "gift") {
    last_chat = "recv";
    chat_add_table += call_chat_list_view(
      "recv",
      datas["contents"],
      datas["send_id"]
    );
  } else if (datas["mode"] == "gift_req") {
    last_chat = "recv";
    chat_add_table += call_chat_list_view_req(
      "recv",
      datas["contents"],
      datas["send_id"]
    );
  }

  if (buffer == true) {
    chat_buff += chat_add_table;
  } else {
    document.getElementById("add_chat").innerHTML += chat_add_table;
  }

  var objDiv = document.getElementById("chat_area");
  objDiv.scrollTop = objDiv.scrollHeight;
}

function make_time(hour, min) {
  if (min < "10" || min < 10) {
    min = "0" + min;
  }
  if (hour > 12) {
    now_time = "오후 " + (hour - 12) + ":" + min;
  } else {
    now_time = "오전 " + hour + ":" + min;
  }
  return now_time;
}

$(document).ready(function () {
  //chat_ajax_call();
  if ($("#user_id").val() != "") {
    setInterval("chat_ajax_call()", 5000);
  }
});

function chat_ajax_call() {
  user_id = $("#user_id").val();
  $.get(
    "/chat/hook_get_chat/" + user_id + "/" + Math.random(),
    function (data) {
      //console.log(data);
      if (data.length > 3) {
        s_data = data.split("↕");

        $.each(s_data[0].split("|"), function (index, x1) {
          $("#chat_read_cnt_" + x1).html("");
        });

        $.each(s_data[1].split("¶"), function (index, x1) {
          if (x1.length > 0) {
            datas = {};
            $.each(x1.split("|"), function (index, x2) {
              var arr = x2.split("=");
              arr[1] && (datas[arr[0]] = decodeURIComponent(arr[1]));
            });

            tmp_data1 = datas["reg_date"].split(" ");
            tmp_data2 = tmp_data1[1].split(":");

            reg_date = make_time(tmp_data2[0], tmp_data2[1]);

            add_chat_recv(datas, reg_date);
          }
        });
      }
    }
  );
}

function chkEnter() {
  if (event.which || event.keyCode) {
    if (event.which == 13 || event.keyCode == 13) {
      chat_text = $("#chat_text").val();

      document.getElementById("chat_submit").click();
    }
  } else {
    return true;
  }
}

function htmlspecialchars(string, quote_style, charset, double_encode) {
  if (string == undefined) {
    return "";
  }

  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === "undefined" || quote_style === null) {
    quote_style = 2;
  }
  string = string.toString();
  if (double_encode !== false) {
    // Put this first to avoid double-encoding
    string = string.replace(/&/g, "&amp;");
  }
  string = string.replace(/</g, "&lt;").replace(/>/g, "&gt;");

  var OPTS = {
    ENT_NOQUOTES: 0,
    ENT_HTML_QUOTE_SINGLE: 1,
    ENT_HTML_QUOTE_DOUBLE: 2,
    ENT_COMPAT: 2,
    ENT_QUOTES: 3,
    ENT_IGNORE: 4,
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== "number") {
    // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/'/g, "&#039;");
  }
  if (!noquotes) {
    string = string.replace(/"/g, "&quot;");
  }

  return string;
}

function mobile_chat_back() {
  if (is_mobile == true) {
    $(location).attr("href", "/profile/my_chat/chatting_list");
  }
}

function chat_exit(user_id) {
  if (
    confirm(
      "채팅방을 나가시면 더이상 채팅이 불가능합니다.\n채팅방을 나가시겠습니까?"
    ) == true
  ) {
    $.get(
      "/chat/chat_exit/user_id/" +
        encodeURIComponent(user_id) +
        "/" +
        Math.random(),
      function (result) {
        if (result == "1") {
          if (is_mobile == true) {
            $(location).attr("href", "/profile/my_chat/chatting_list");
          } else {
            self.close();
            opener.location.reload();
          }
        } else if (result == "10") {
          if (is_mobile == true) {
            $(location).attr("href", "/profile/my_chat/chatting_list");
          } else {
            self.close();
            opener.location.reload();
          }
        } else {
          alert("잘못된 접근입니다. (" + result + ")");

          if (is_mobile == true) {
            $(location).attr("href", "/profile/my_chat/chatting_list");
          } else {
            self.close();
            opener.location.reload();
          }
        }
      }
    );
  }
}

function chat_exit_sub(mode, user_id) {
  if (mode == "1") {
    chat_exit(user_id);
  } else if (mode == "2") {
    if (is_mobile == "false") {
      chat_request(user_id);
      self.close();
    } else {
      chat_request(user_id);
    }
  } else {
    alert("잘못된 접근입니다.");
  }
}

function chat_request(user_id) {
  alert("hh");
  $.get(
    "/chat/chat_request_mobile/user_id/" + user_id + "/" + Math.random(),
    function (data) {
      //작은창을 띄워야하기위해 강제로 chat_request_mobile 호출

      if (data == "error") {
        alert("동성간의 채팅은 불가능합니다.");
        return;
      } else if (data == "alreay_chat") {
        if (
          confirm("이미 채팅중인 회원입니다.\n채팅창으로 이동하시겠습니까?") ==
          true
        ) {
          $(location).attr("href", "/chat/chatting/" + user_id);
        } else {
          modal.close();
        }
      } else if (data == "ban") {
        alert("이미 채팅신청을 한 회원입니다.\n채팅수락 대기중입니다.");
        return;
      } else {
        modal.open({ content: data, width: 320 });
      }
    }
  );
}

function renew_chat_exit(user_id) {
  if (user_id == "") {
    alert("잘못된 접근입니다.");
    return;
  }

  if (confirm("채팅방을 나가시겠습니까?") == true) {
    $.ajax({
      type: "post",
      url: "/chat/renew_chat_exit",
      data: {
        user_id: encodeURIComponent(user_id),
      },
      cache: false,
      async: false,
      success: function (result) {
        if (result == "ready") {
          alert("채팅신청 및 채팅수락 전에는 나가기가 안됩니다.");
          return;
        }

        if (is_mobile == true) {
          $(location).attr("href", "/profile/my_chat/chatting_list");
        } else {
          opener.location.reload();
          self.close();
        }
      },
      error: function (result) {
        alert("실패 (" + result + ")");
      },
    });
  }
}
