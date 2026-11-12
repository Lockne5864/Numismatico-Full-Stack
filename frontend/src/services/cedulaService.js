import { api as axios } from "src/boot/axios";

export default class cedulaService {
  constructor() {
    this.URL = "";
  }
  async create(body) {
    try {

      return await axios.post(`${this.URL}/`, { ...body });

      return;
    } catch (err) {
      throw err;
    }
  }
  async changeToMarketplace(idCedula) {
    try {

      return await axios.post(`${this.URL}/${idCedula}`);
    } catch (err) {
      throw err;
    }
  }
  async getMyCedula(id) {
    try {
      const cedula = await axios.get(`${this.URL}/${id}`);

      return cedula.data.money;
    } catch (err) {
      throw err;
    }
  }
  async getMarcketplaceCedula() {
    try {
      const cedula = await axios.get(`${this.URL}/`);

      return cedula.data.money;
    } catch (err) {
      throw err;
    }
  }
}
