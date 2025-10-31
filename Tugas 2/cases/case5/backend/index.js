const express = require("express");
const mongoose = require("mongoose");
const app = express();
app.use(express.json());

mongoose.connect("mongodb://mongo:27017/userdb")
  .then(() => console.log("MongoDB connected"))
  .catch(err => console.log(err));

const UserSchema = new mongoose.Schema({ name: String });
const User = mongoose.model("User", UserSchema);

app.get("/", (req, res) => res.send("API is running"));

app.get("/users", async (req, res) => {
  const users = await User.find();
  res.json(users);
});

app.post("/users", async (req, res) => {
  const user = await User.create({ name: req.body.name });
  res.json(user);
});

app.listen(4000, () => console.log("Server running on port 4000"));
