var container = '<div ' +
    'title="<%-fname%> <%-lname%>" ' +
    'data-content="Age: <%-bdate%> <strong><%-ripdate%></strong>\nSex: <strong><%-sex%></strong>\nDescription: <strong><%-description%></strong>" ' +
    'class="humanContainer ui-widget-content newContainer id<%-id%>" ' +
    'role="button" ' +
    'data-toggle="popover" ' +
    'data-trigger="focus" ' +
    'id="container_<%-id%>" ' +
    'data-id="<%-id%>" ' +
    'draggable="true">'+
    '<div class="glyphicon glyphicon-user" style="display: block;width:100%;height: 50px;font-size:50px;"><%-photo%></div>'+
    '<label><%-fname%> <%-lname%></label>'+
    '</div>';
