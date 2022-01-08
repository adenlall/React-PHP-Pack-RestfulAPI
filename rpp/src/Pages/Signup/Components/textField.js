import './textField.css';
import React from 'react';
import TextField from '@material-ui/core/TextField';
 
function TextBox(props){
  return (
    <div className="form">
      <TextField
        label={props.label}
        value={props.value}
        onChange={props.onChange}
        variant="outlined"
        style={{ width: "100%" }}
      />{" "}
    </div>
  );
}
 
export default TextBox;