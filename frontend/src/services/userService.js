import { api as axios } from "src/boot/axios";

export default class userService {
  constructor() {
    this.URL = "/login";
  }
  async login(body) {
    try {
      return await axios.post(`${this.URL}/login`, { ...body });

      return;
    } catch (err) {
      throw err;
    }
  }
  async register(body) {
    try {
      return await axios.post(`${this.URL}/register`, { ...body });
    } catch (err) {
      throw err;
    }
  }
  async forgotpassword(body) {
    return await axios.post(`${this.URL}/forgotpassword`, { ...body });
  }
  async resetpassword(body) {
    try {
      return await axios.post(`${this.URL}/resetpassword`, { ...body });
    } catch (err) {
      throw err;
    }
  }
}
