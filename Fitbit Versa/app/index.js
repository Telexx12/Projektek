import { View, Text } from '@fitbit/fading-text';
import { me } from 'appbit';
import * as document from "document";


const myLabel = document.getElementById("myLabel");

setInterval(function() {
  let now = new Date();
  let hours = now.getHours();
  let minutes = now.getMinutes();
  let seconds = now.getSeconds();

  myLabel.text = `${hours}:${minutes}:${seconds}`;
}, 1000);