import { api as axios } from "src/boot/axios";

export default class collectionService {
  constructor() {
    this.URL = "/collection";
    this.userId = JSON.parse(localStorage.getItem("user")).id;
  }
  async getAll() {
    try {
      const collections = await axios.get(`${this.URL}/${this.userId}/all`);

      return collections.data.collection;
    } catch (err) {
      throw err;
    }
  }
  async getByCollection(collectionId) {
    try {
      const collections = await axios.get(
        `${this.URL}/${this.userId}/${collectionId}`
      );
      return collections.data.collection;
    } catch (err) {
      throw err;
    }
  }
  async add(body) {
    try {
      return await axios.post(`${this.URL}/${this.userId}/add`, { ...body });
    } catch (err) {
      throw err;
    }
  }
  async edit(collectionId, body) {
    try {
      return await axios.post(
        `${this.URL}/${this.userId}/${collectionId}/edit`,
        { ...body }
      );
    } catch (err) {
      throw err;
    }
  }
}
